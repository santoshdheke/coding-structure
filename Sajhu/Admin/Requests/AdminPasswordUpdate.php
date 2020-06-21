<?php

namespace Module\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPasswordUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'
        ];
    }
}
