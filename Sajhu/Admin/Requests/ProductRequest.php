<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Module\Vendor\Rules\AttributeExists;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|max:100',
            'short_description' => '',
            'long_description' => '',
            'category_id' => 'required',
//            'attribute_ids' => ['required', new AttributeExists],
//            'attribute_ids.*' => 'required',
            'main_product_image' => 'required',
//            'back_image' => 'required',
//            'back_image.*' => 'required|max:' . config('image.size') . '|mimes:' . config('image.type'),
        ];
    }
}
