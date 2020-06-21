<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Module\Admin\Rules\ParentMeasurementCheck;

class NonMeasurementAddRequest extends FormRequest
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
            'parent_id' => ['required', new ParentMeasurementCheck]
        ];

        if (request()->compare_parent_value){
            $rule['compare_parent_value'] = 'numeric|max:9999999999';
        }

        return $rule;
    }
}
