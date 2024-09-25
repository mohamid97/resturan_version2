<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContactResource;
use App\Models\Admin\Contactus;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $contact = Contactus::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        return  $this->res(true ,'Contact Us page' , 200 ,ContactResource::collection($contact));

    }
}
