<?php

namespace App\Repositories;

use App\Emp_dep_position;
use App\Repositories\Interfaces\EmployeeDepartmentPositionRepositoryInterfaces;


//use Your Model

/**
 * Class Employee.
 */
class EmployeeDepartmentPositionRepository implements EmployeeDepartmentPositionRepositoryInterfaces

{
    /**
     * @return string
     *  Return the model
     */
    // public function saveEmployee($request)
    // {

    //     $employee = new Employee();
    //     $employee->employee_name = $request['employee_name'];
    //     $employee->email = $request['email'];
    //     $employee->dob = $request['dob'];
    //     $employee->password = $request['password'];
    //     $employee->gender = $request['gender'];
    //     $employee->save();
    // }
        public function saveEmployeeDep($employeeId,$pos_id,$dep_id)
        {
            $emp_dep_pos=new Emp_dep_position();
            $emp_dep_pos->employee_id=$employeeId;
            $emp_dep_pos->department_id=$dep_id;
            $emp_dep_pos->position_id=$pos_id;

            try{

                $emp_dep_pos->save();
                return true;
            }
            catch (Exception $e){

                return false;
            }

        }

        // public function updateEmployeeDep($employeeId,$pos_id,$dep_id)
        // {
            
        // }

}
