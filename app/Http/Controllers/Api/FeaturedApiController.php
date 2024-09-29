<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FeaturedProductsResource;
use App\Models\Admin\Features;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class FeaturedApiController extends Controller
{
    use ResponseTrait;
    //
    public function get(){
        $featured = Features::with(['product.gallery' , 'product.types.options' , 'product.extras' , 'product.combos'])->get();
        return $this->res(true , 'All Featured Products' , 200 , FeaturedProductsResource::collection($featured));
    }
}
