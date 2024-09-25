<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OurworkResource;
use App\Models\Admin\Ourwork;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class OurWorks extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $our_works = Ourwork::with('media')->get();
        return  $this->res(true ,'Our Works or Projects' , 200 ,OurworkResource::collection($our_works));

    }
}
