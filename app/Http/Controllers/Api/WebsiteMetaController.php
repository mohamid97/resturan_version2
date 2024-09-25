<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\MetaResource;
use App\Models\Admin\Meta;
use App\Models\Admin\MetaBlogs;
use App\Models\Admin\MetaCategory;
use App\Models\Admin\MetaProducts;
use App\Models\Admin\MetaServices;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class WebsiteMetaController extends Controller
{
    private $meta = [];
    private $metaData = [];
    use ResponseTrait;
    //
    public function get()
    {
        $this->meta['website_meta'] = Meta::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        $this->meta['services_meta'] = MetaServices::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
    
        $this->meta['products_meta'] = MetaProducts::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
    
    
        $this->meta['categories_meta'] = MetaCategory::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
    
        $this->meta['blogs_meta'] = MetaBlogs::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
       
        foreach ($this->meta as $key => $collection) {
            if (isset($collection) && $collection->isNotEmpty()) {
                $this->metaData[$key] = MetaResource::collection($collection);
            } 
        }
    
        return  $this->res(true ,'All Main Meta Of Website' , 200 ,$this->metaData);
    }
}
