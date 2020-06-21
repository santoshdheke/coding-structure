<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeAddRequest extends FormRequest
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
        $arr = [
            'attribute_title' => 'required|max:100',
            'input_type' => 'required|in:number,radio,checkbox,select,text',
            'attributeable_type' => 'required|in:Module\Admin\Models\Measurement,Module\Admin\Models\NonMeasurement',
            'measurement_id' => 'required|exists:measurements,id'
        ];

        if (request('attributeable_type') == "Module\Admin\Models\NonMeasurement"){
            $arr['non_measurement_id'] = 'required|exists:non_measurements,id';
        }else{
            $arr['measurement_id'] = 'required|exists:measurements,id';
        }

        return [];
    }
}
