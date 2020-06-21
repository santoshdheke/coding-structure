<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
                'first_name' => 'required|max:255',
                'middle_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|max:255|unique:vendors,email',
                'company_phone_no' => 'required|max:20',
                'username' => 'required|max:20',
                'company_name' => 'required|max:50',
                'logo' => 'nullable',
                'address' => 'required',
                'mobile_no' => 'required|max:20',
                'company_pan_no' => 'required|max:50',
                'status' => 'nullable',
        ];
    }
}
