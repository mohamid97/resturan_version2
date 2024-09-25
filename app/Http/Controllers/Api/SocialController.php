<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SocialMediaResource;
use App\Models\Admin\SocialMedia;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $social = SocialMedia::all();
        return  $this->res(true ,'Social media links and status' , 200 ,SocialMediaResource::collection($social));

    }
}
