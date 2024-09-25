<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryDetailsResource;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Admin\Category;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            });
        }])->with('products.gallery')->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();

        
        return  $this->res(true ,'All Categories ' , 200 ,CategoryResource::collection($categories));

    }

    public function get_details(Request $request){

        // get cateogory with slug
        $category_details =Category::whereHas('translations', function ($query) use($request) {
            $query->where('slug' , $request->slug);
        })->first();


        if(isset($category_details)){
            if($category_details->locale != app()->getLocale() ){
                $category_details = Category::where('id' , $category_details->id)->whereHas('translations', function ($query) {
                    $query->where('locale', '=', app()->getLocale());
                })->first();
            }
        }



        if(optional($category_details)->exists()){
            return  $this->res(true ,'Category Details' , 200 , new CategoryDetailsResource($category_details));
        }

        return  $this->res(false ,'Category details not found. Maybe there is no data with this slug or no data in this language.' , 404);


        
    }


    public function get_category_with_sub(){


        $categories = Category::with('childs')->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->where('type' , '0')->get();
        return  $this->res(true ,'All Categories ' , 200 ,CategoryResource::collection($categories));

    }
}
