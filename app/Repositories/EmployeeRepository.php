<?php

namespace App\Repositories;

use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\EmployeeRepositoryInterfaces;
use Illuminate\Support\Facades\Log;

//use Your Model

/**
 * Class Employee.
 */
class EmployeeRepository implements EmployeeRepositoryInterfaces
{
    /**
     * @return string
     *  Return the model
     */
    public function saveEmployee($request)
    {

        $employee = new Employee();
        $employee->employee_name = $request['employee_name'];
        $employee->email = $request['email'];
        $employee->dob = $request['dob'];
        $employee->password = $request['password'];
        $employee->gender = $request['gender'];
        $employee->save();
    }
    public function checkEmployee($request)
    {
        $employeeId=$request->id;

        $employee=DB::table('employees')
                    ->leftJoin('emp_dep_positions','employees.id','=','emp_dep_positions.employee_id')
                    ->where('employees.id',$employeeId)
                    ->get();
    return $employee;
    }

    public function updateEmployee($request)
    {
        $employee=DB::table('employees')
                    ->where('id', $request->id)
                    ->update([  'employee_name' => $request->employee_name,
                                'email' =>$request->email,
                                'dob' =>$request->dob,
                                'password' =>$request->password,    
                                'gender' =>$request->gender,
                    ]);
        return $employee;

    }
}
