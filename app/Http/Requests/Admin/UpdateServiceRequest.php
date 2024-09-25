<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name.*'=>'required|string',
            'slug.*'=>'required|string',
            'des.*'=>'nullable|string',
            'meta_title.*'=>'nullable|string',
            'meta_des.*'=>'nullable|string',
            'category'=>'nullable',
            'photo.*'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'price'=>'nullable'
        ];
    }
}
