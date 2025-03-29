<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'category_id' => ['required', 'exists:categories,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
