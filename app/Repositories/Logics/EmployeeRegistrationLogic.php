<?php
namespace App\Repositories\Logics;

use App\Employee;
use App\Repositories\Interfaces\EmployeeDepartmentPositionRepositoryInterfaces;


class EmployeeRegistrationLogic
    {
        public function __construct(EmployeeDepartmentPositionRepositoryInterfaces $employeeRepo)
            {       
                $this->employeeRepo = $employeeRepo;
            }

        
        public function savePrepareData($request)
        {
            if($request->position_id){ // position id from positions table

                $pos_id=$request->position_id;
            }
            else{
                $pos_id=1;
            }
    
            if($request->department_id){
    
                $dep_id=$request->department_id;
            }
            else{
                $dep_id=1;
            }
            $employeeId=Employee::max('id');
            $this->employeeRepo->saveEmployeeDep($employeeId,$pos_id,$dep_id);
        }
    }