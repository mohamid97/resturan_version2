<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCmsRequest extends FormRequest
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
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'name.*'=>'required|string|max:255',
            'des.*' =>'required|string',
            'small_des.*' =>'nullable|string',
            'meta_title.*'=>'required|string',
            'meta_des.*'  =>'required|string',
            'alt_image.*'=>'required|string',
            'title_image.*'=>'required|string'

        ];
    }
}
