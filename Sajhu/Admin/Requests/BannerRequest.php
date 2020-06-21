<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'banner_name' => 'required|max:100',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'banner_name.required' => 'Please Enter the Banner Name'
        ];
    }
}
