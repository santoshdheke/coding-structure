<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Module\Admin\Rules\ParentMeasurementCheck;

class NonMeasurementUpdateRequest extends FormRequest
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
        $rule = [
            'title' => 'required|max:100',
        ];

        return $rule;
    }
}
