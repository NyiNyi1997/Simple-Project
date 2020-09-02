<?php

namespace App\Repositories\Interfaces;


interface EmployeeRepositoryInterfaces
{
    public function saveEmployee($request);

    public function checkEmployee($request);

    public function updateEmployee($request);
}