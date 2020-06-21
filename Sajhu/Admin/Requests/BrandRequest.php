<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_name' => 'required|max:100|unique:brands,brand_name'
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' =>'Please Enter The Brand Name'
        ];
    }
}
