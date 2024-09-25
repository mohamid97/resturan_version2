<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\MisssionVissionResource;
use App\Models\Admin\MissionVission;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class MissionVisionController extends Controller
{

    use ResponseTrait;
    //
    public function get(){
        $mission = MissionVission::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();


        return  $this->res(true ,'Mission and vission and services and about text ' , 200 ,MisssionVissionResource::collection($mission));


       

    }
}
