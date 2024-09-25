<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryImageRequest extends FormRequest
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
            'photo'               =>'required|image',
            'name.*'              =>'nullable|string',
            'alt_image.*'         =>'nullable|string',
            'title_image.*  '     =>'nullable|string',
            'group_media'         =>'required|integer'
        ];
    }
}
