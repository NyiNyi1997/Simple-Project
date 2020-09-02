<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRegistratinValidationRequest;
use App\Http\Requests\EmployeeUpdateValidationRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterfaces;
use App\Repositories\Logics\EmployeeRegistrationLogic;
use Illuminate\Support\Facades\Log;


class EmployeeRegistrationController extends Controller
{
    //
    public function __construct(EmployeeRepositoryInterfaces $employeeRepo,EmployeeRegistrationLogic $employeeLogic)
    {       
        $this->employeeRepo = $employeeRepo;
        $this->employeeLogic = $employeeLogic;
    }
    
    public function save(EmployeeRegistratinValidationRequest $request)
    {
        
        $this->employeeRepo->saveEmployee($request);
        $this->employeeLogic->savePrepareData($request);
    } 

    public function update(Request $request)
    {
       
        $employee=$this->employeeRepo->checkEmployee($request);
        if($employee->isEmpty())
        {
            return response()->json(['status'=>'NG','message'=>'Id not found!'],200);
        }else{
            $this->employeeRepo->updateEmployee($request);
        }
    }
}
