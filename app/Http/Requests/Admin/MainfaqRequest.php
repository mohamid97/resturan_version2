<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class MainfaqRequest extends FormRequest
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
            'title.*'=>'required|string',
            'des.*'  =>'required|string',
            'image'  =>'nullable|image',
            'alt_image.*'=>'nullable|string',
            'title_image.*'=>'nullable|string',

        ];
    }
}
