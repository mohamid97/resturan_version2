<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainfaqRequest;
use App\Http\Resources\Admin\FaqResource;
use App\Http\Resources\Admin\MainFaqResource;
use App\Models\Admin\Faq;
use App\Models\Admin\MainFaq;
use App\Trait\ResponseTrait;

class FaqController extends Controller
{

    use ResponseTrait;
    //
   public function get(){
      $main_faq = MainFaq::whereHas('translations', function ($query) {
        $query->where('locale', '=', app()->getLocale());
        })->first();
      $faq = Faq::whereHas('translations', function ($query) {
        $query->where('locale', '=', app()->getLocale());
       })->get();


       return  $this->res(true ,'About Us Page ' , 200 ,['main_faq' => new MainFaqResource($main_faq) , 'faqs'=> FaqResource::collection($faq)]);



   } // end function 


}
