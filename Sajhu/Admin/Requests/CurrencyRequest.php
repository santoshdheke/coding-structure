<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
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
            'currency_name' => 'required|max:50',
            'symbol_area' => [
                'required',
                Rule::in(['front', 'back'])
            ],
            'symbol' => 'required|max:10',
            'compare_with_dolor' => 'required|integer|max:1000|min:-1000',
        ];
    }
}
