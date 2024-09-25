<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SliderResource;
use App\Models\Admin\Slider;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $sliders = Slider::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        return  $this->res(true ,'All Sliders' , 200 ,SliderResource::collection($sliders));
    }
}
