<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\MediaGroupResource;
use App\Models\Admin\MediaGroup;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use ResponseTrait;
    //
    public function get_media_group(){

        $media = MediaGroup::with(['gallerys' , 'files' , 'viedos'])->get();
        return  $this->res(true ,'All Media Group' , 200 ,MediaGroupResource::collection($media));

    }
}
