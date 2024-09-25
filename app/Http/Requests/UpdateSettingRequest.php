<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
  
        return [
            'logo'                             =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'favicon'                          =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'home_breadcrumb_background'       =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'contact_breadcrumb_background'    =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'about_breadcrumb_background'      =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'products_breadcrumb_background'   =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'categories_breadcrumb_background' =>'nullable|image|mimes:jpeg,png,jpg,gif,webp' ,
            'services_breadcrumb_background'   =>'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'website_name.*'                   =>'required|string',
            'website_des.*'                    =>'required|string',
            'working_hours.*'                    =>'nullable|string'
        ];
    }
}
