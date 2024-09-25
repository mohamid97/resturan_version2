<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditOurWorkRequest extends FormRequest
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
            'name.*'=>'required|string|max:255',
            'des.*'=>'nullable|string',
            'icon'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'link'=>'nullable|string',
            'meta_des.*'=>'required|string',
            'meta_title.*'=>'required|string',
            'alt_image.*'=>'required|string',
            'title_image'=>'required|string',
            'media_id'=>'nullable|integer'


        ];
    }
}
