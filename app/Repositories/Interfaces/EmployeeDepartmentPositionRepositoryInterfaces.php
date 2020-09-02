<?php

namespace App\Repositories\Interfaces;


interface EmployeeDepartmentPositionRepositoryInterfaces
{
    // public function saveEmployee($request);
    public function saveEmployeeDep($employeeId,$pos_id,$dep_id);

}