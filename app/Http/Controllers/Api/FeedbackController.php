<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FeedBackResource;
use App\Models\Admin\Feedback;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    use ResponseTrait;
    public function get()
    {
        $feeds = Feedback::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        return  $this->res(true ,'All Feedbacks' , 200 ,FeedBackResource::collection($feeds));
    }
    
}
