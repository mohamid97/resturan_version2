<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LangsResource;
use App\Models\Admin\Lang;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class LangController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {

        $langs = Lang::all();
        return  $this->res(true ,'All Lang In Website' , 200 ,LangsResource::collection($langs));
    }
}
