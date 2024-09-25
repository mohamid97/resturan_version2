<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryDetailsResource;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\Admin\ProductDetailsResource;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Trait\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class ProductController extends Controller
{
    use ResponseTrait;
    public function get()
    {
        $products = Product::with(['category' , 'gallery'])->get();
        return  $this->res(true ,'All Products' , 200 ,ProductResource::collection($products));
    }
    public function get_product_details(Request $request) {

        $request->validate([
            'slug'=>'required|string'
        ]);
        $productdetails = Product::with(['category' , 'gallery' , '' , '' ])->whereHas('translations', function ($query) use($request) {
            $query->where('locale', '=', app()->getLocale())->where('slug' , $request->slug);
        })->first();

        if(optional($productdetails)->exists()){
            return  $this->res(true ,'product Details' , 200 , new ProductDetailsResource($productdetails));
        }

        return  $this->res(false ,'product details not found. Maybe there is no data with this slug or no data in this language.' , 404);
    }

    public function get_product_category(Request $request){
        $request->validate([
            'category_id'=>'required|integer'
        ]);
        $products = Product::with(['category' , 'gallery'])->where('category_id' , $request->category_id)->get();
        return  $this->res(true ,'All Products' , 200 ,ProductResource::collection($products));

    }


    // get products with category slug
    public function get_product_slug(Request $request){

        try{
            $request->validate([
                'category_slug'=>'required|string'
            ]);

            $category_details = Category::with(['products.gallery' , 'translations'])->whereHas('translations', function ($query) use ($request) {
                $query->where('slug', $request->category_slug);
            })->first();
            if(isset($category_details)){
    
                // Find the translation that matches the provided slug
                $translation = $category_details->translations->firstWhere('slug', $request->category_slug);
    
                // Get the locale (language) of the matching translation
                $slug = $translation->slug;
                $locale = $translation->locale;  // 'ar' or 'en', depending on the slug
                if($locale != app()->getLocale() ){
                    $category_details = Category::with('products.gallery')->where('id' , $category_details->id)->whereHas('translations', function ($query) {
                        $query->where('locale', '=', app()->getLocale());
                    })->first();
                }
            }
            if(optional($category_details)->exists()){
                return  $this->res(true ,'All Categories with products ' , 200 ,new CategoryResource($category_details));
            }

            return  $this->res(true ,'Category details not found. Maybe there is no data with this slug or no data in this language.' , 404);

        } catch (ValidationException $e) {

           return  $this->res(false , 'Validation Error' , 422,   ['errors' => $e->errors()]);

    
        }catch(\Exception $e){

            return  $this->res(false ,$e->getMessage() , $e->getCode());

        }



    } //   end of  get product with slug


      

    
}

