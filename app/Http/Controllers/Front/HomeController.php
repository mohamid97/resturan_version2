<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\Achievement;
use App\Models\Admin\Category;
use App\Models\Admin\Contactus;
use App\Models\Admin\Des;
use App\Models\Admin\Meta;
use App\Models\Admin\OurClient;
use App\Models\Admin\Ourwork;
use App\Models\Admin\Slider;
use App\Models\Admin\SocialMedia;
use App\Models\SliderSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $sliders = Slider::all();
        $slider_setting = SliderSetting::first();
        $about = About::first();
        $our_works = Ourwork::all();
        $des = Des::first();
        $category = Category::with('services')->get();
        $achievement = Achievement::first();
        $website_meta = Meta::first();
      
        $clients = OurClient::all();
        return view('front.home' , [
            'sliders'          => $sliders,
            'slider_setting'   => $slider_setting ,
            'about'            => $about ,
            'our_works'        => $our_works,
            'des'              => $des,
            'category'         => $category,
            'achievement'      => $achievement,
            'clients'          =>$clients,
            'meta'             =>$website_meta
        ]);


    }
}
