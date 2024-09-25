<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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
            'facebook'=>'nullable|string|max:255',
            'twitter'=>'nullable|string|max:255',
            'instagram'=>'nullable|string|max:255',
            'tiktok'=>'nullable|string|max:255',
            'youtube'=>'nullable|string|max:255',
            'snapchat'=>'nullable|string|max:255',
            'whatsup'=>'nullable|string|max:255',
        ];
    }
}
