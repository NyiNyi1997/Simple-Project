<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateValidationRequest extends FormRequest
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
            //
            'employee_name' => 'required|max:20|string',
            'email'=>'required:max:20|unique:employees',
            'dob'=>'required|date_format:"Y-m-d"',
            'password'=>'required|min:10',
            'gender'=>'required|in:1,2',
        ];
    }
}
