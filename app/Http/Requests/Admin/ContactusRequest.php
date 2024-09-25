<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
            //
            'email'=>'required|email',
            'des.*'=>'nullable|string',
            'meta_title.*'=>'required|string',
            'meta_des.*'=>'required|string',
            'title_image.*'=>'required|string',
            'alt_image.*'=>'required|string',
            'phone1'=>'nullable|string',
            'phone2'=>'nullable|string',
            'phone3'=>'nullable|string',
            'address.*'=>'nullable|string',
            'address2.*'=>'nullable|string',
            'name.*'=>'required|string',
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp'
        ];
    }
}
