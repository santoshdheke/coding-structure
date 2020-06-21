<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_title' => 'required|max:100|unique:categories,category_title,'.request()->route('category'),
            'category_icon' => 'max:'.config('image.size').'|mimes:'.config('image.type'),
        ];
    }
}
