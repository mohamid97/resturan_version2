<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AchivementResource;
use App\Models\Admin\Achievement;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class AchivementController extends Controller
{
    use ResponseTrait;
    //
    public function get(){
        $statistics = Achievement::first();
        return  $this->res(true ,'All statistics' , 200 , new AchivementResource($statistics));
    }
}
