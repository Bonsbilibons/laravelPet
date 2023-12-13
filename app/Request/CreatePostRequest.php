<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:2000'],
            'status' => ['required', 'in:0,1'],
            'category' => ['required'],
            'image' => ['array'],
            'image.*' => ['image', 'max:2048'],
        ];
    }
}
