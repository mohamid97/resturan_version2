<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SettingsResource;
use App\Models\Admin\Setting;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $setting = Setting::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        return  $this->res(true ,'Settings Of Website' , 200 ,SettingsResource::collection($setting));

    }
}
