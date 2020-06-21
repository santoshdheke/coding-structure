<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
            'country_name' => 'required|max:100',
            'country_code' => 'required|max:10',
            'flag' => 'required|max:'.config('image.size').'|mimes:'.config('image.type'),
        ];
    }
}
