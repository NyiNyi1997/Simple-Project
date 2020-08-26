<?php

namespace App\Http\Controllers;

use App\Employee;

use App\Emp_dep_position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $employee = new Employee();
        $employee->employee_name = $request['employee_name'];
        $employee->email = $request['email'];
        $employee->dob = $request['dob'];
        $employee->password = $request['password'];
        $employee->gender = $request['gender'];
        $employee->save();

        $lastemp_id=Employee::max('id');

        if($request->position_id){

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

        $employee_dep_pos=new Emp_dep_position();

        $employee_dep_pos->employee_id=$lastemp_id;
        $employee_dep_pos->department_id=$dep_id;
        $employee_dep_pos->position_id=$pos_id;
        
        $employee_dep_pos->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $employee=Employee::whereId($id)->firstOrFail();
        $employee->employee_name=$request->employee_name;
        $employee->email=$request->email;
        $employee->dob=$request->dob;
        $employee->password=$request->password;
        $employee->gender=$request->gender;
        $employee->update();
      

        if($request->position_id){

            $pos_id=$request->position_id;
        }
        else{
            $pos_id=1;
        }

        $emp_dep_pos= Emp_dep_position::where('employee_id',$id)->first();
            if($emp_dep_pos){
                if($request->department_id){
                    $emp_dep_pos->department_id=$request->department_id;
                }
                if($request->position_id){
                    $emp_dep_pos->position_id=$pos_id;
                }
                $emp_dep_pos->update();
            } 
            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee=Employee::whereId($id)->firstOrFail();
        $employee->delete();

    }
}
