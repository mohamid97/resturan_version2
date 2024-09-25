<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Cms;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use App\Models\Admin\Message;
use App\Models\Admin\Product;
use App\Models\Admin\Service;
use App\Models\Admin\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // index function return home admin page

    public function index()
    {
    
        
        $users      = User::where('type' ,'!=' , 'admin')->count();
        $messages   = Message::count();
        $categories = Category::count();
        $products   = Product::count();
        $services   = Service::count();
        $blogs       = Cms::count();
        $langs       = Lang::count();
        $media_group = MediaGroup::count();
        $sliders     = Slider::count(); 
        $latest_messages = Message::latest()->take(5)->get();
        return view('admin.home' , [
            'users'           => $users,
            'messages'        => $messages,
            'categories'      => $categories,
            'products'        => $products,
            'services'        => $services,
            'blogs'           => $blogs,
            'latest_messages' => $latest_messages, 
            'langs'           => $langs,
            'media_group'     =>$media_group,
            'sliders'         => $sliders
        ]);

    }
}
