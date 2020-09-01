<?php

namespace App\Http\Requests;

use App\Http\Requests\EmployeeStoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
            //
            return [
                'employee_name' => 'required|max:20',
                'email'=>'required',
                'dob' => 'required|max:20',
                'password' => 'required|max:20',
                'gender'=>'required',
            ];
        
    }
}
