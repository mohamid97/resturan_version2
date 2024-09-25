<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AboutResource;
use App\Models\Admin\About;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use ResponseTrait;
   public function get()
   {
       $about = About::whereHas('translations', function ($query) {
        $query->where('locale', '=', app()->getLocale());
    })->get();
       return  $this->res(true ,'About Us Page ' , 200 ,AboutResource::collection($about));

   }
}
