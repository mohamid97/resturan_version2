<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends FormRequest
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
            'image'          =>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'icon'           =>'image|mimes:jpeg,png,jpg,gif,svg',
            'name.*'         =>'required|max:255',
            'small_des.*'    =>'nullable|max:255',
            'des.*'          =>'nullable|max:5000',
        ];
    }
}
