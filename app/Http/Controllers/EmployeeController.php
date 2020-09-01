<?php

namespace App\Http\Controllers;

use App\Employee;

use App\Emp_dep_position;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;



/** 
*@Description ->show,insert,update,delete,forceDelete form employees and emp_dep_position and send email
*@author ->Nyi Nyi Aung
*@date ->26/8/2020
*/

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**  
    *@Description-> show employee data with paginate 
    *@author-> nyi nyi aung
    *@date->28/08/2020
    *@return $employee[]={id,employee_name,email,dob,password,gender}
    */
    public function index()
    {
        //
        //$limit=(int)env('limit');//number of paginate limit per page
        $perPage=Config::get('constant.per_page');
        $employee=Employee::with('department','position')->withTrashed()->paginate($perPage);
        return $employee;
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

    /**  
    *@Decription-> store  data employees table and emp_dep_position and send 
    *@author-> nyi nyi aung
    *@param->$request
    *@date->26/08/2020
    */

    public function store(Request $request)
    {
        try{

        $employeeId=Config::get('constant.employee_id');

        $data = $request->validate([
            'employee_name' => 'required|max:20',
            'email'=>'required:max:20|unique:employees',
            'password'=>'required',
            'gender'=>'required:max:20',
           
        ]);
        

        $employee = new Employee();
        $employee->employee_name = $request['employee_name'];
        $employee->email = $request['email'];
        $employee->dob = $request['dob'];
        $employee->password = $request['password'];
        $employee->gender = $request['gender'];
        $employee->save();

        $lastemp_id=Employee::max('id');

        if($request->position_id){ // position id from positions table eg-2,3,4

            $pos_id=$request->position_id;
        }
        else{
            $pos_id=$employeeId;
        }

        if($request->department_id){

            $dep_id=$request->department_id;
        }
        else{
            $dep_id=$employeeId;
        }

        $employee_dep_pos=new Emp_dep_position();

        $employee_dep_pos->employee_id=$lastemp_id;
        $employee_dep_pos->department_id=$dep_id;
        $employee_dep_pos->position_id=$pos_id;
        
        $employee_dep_pos->save();

        //$email=$request['email'];
        Mail::raw('Your Registration is finish.',function($message){

            $message->subject('Registration')->from('lonlon.blah@gmail.com')->to('nynyia128@gmail.com');
        });
        return response()->json([
            'message'=>'Successful Store'
        ],200);
        }
    catch(QueryException $e){
         return response()->json([
            'message'=>$e->getMessage()
         ]);
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**  
    *@Decription->show data form employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->27/08/2020
    *@param->$id
    *@return->$employee[]=employee_name,email,password,dob,gender,department_id,position_id
    */
    public function show($id)
    {
        //Employees Details 
        try{
        $employee=Employee::with('Department','Position')->where('id',$id)->first();
        return $employee;

        return response()->json([
            'message'=>'Successful Employee List'
        ],200);
        }
    catch(QueryException $e){
         return response()->json([
            'message'=>$e->getMessage()
         ]);
            
        }
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

     /**  
    *@Decription-> update  data employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param $request,$id
    */
    public function update(Request $request, $id)
    {
        //

        try{

        $positionId=Config::get('constant.position_id');

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
            $pos_id=$positionId;
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

            return response()->json([
                'message'=>'Successful update'
            ],200);
            }
        catch(QueryException $e){
             return response()->json([
                'message'=>$e->getMessage()
             ]);
               
            }
            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**  
    *@Decription-> delete  data employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param->$id
    */
    public function destroy($id)
    {
        //
        
    
        try{
        
        $employee=Employee::whereId($id)->firstOrFail();
        $employee->delete();

       
        $employee_dep_delete= Emp_dep_position::where('employee_id',$id)->firstOrFail();
        $employee_dep_delete->delete();

        return response()->json([
            'message'=>'Successful Delete'
        ],200);

        return response()->json([
            'message'=>'Successful Delete'
        ],200);
        
    }
    catch(QueryException $e){
         return response()->json([
            'message'=>$e->getMessage()
         ]);
            
        }

   
    }

       /**
    *@Description->force delete  data employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param->$id
    */
    public function forceDelete($id)
    {
        //

        try{
        $employee= Emp_dep_position::withTrashed()->where('employee_id',$id)->firstOrFail();
        $employee->forcedelete();

        $employee=Employee::withTrashed()->whereId($id)->firstOrFail();
        $employee->forcedelete();

        return response()->json([
            'message'=>'Successful Force Delete'
        ],200);
    }
    catch(QueryException $e){
         return response()->json([
            'message'=>$e->getMessage()
         ]);
    }

    }

    /** 
    *@Decription-> search data from employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->27/08/2020
    *@param->$id
    *@return->$employee[]=employee_name,email,password,dob,gender,department_id,position_id
    */
    
    public function search(Request $request){
           
                
            // Artisan::call('cache:clear'); //cache clear 
            // Artisan::call('config:cache'); //cache clear

            $search_data=[];
            if($request->id){ //employee id
                $search_id=['id',$request->id];
                array_push($search_data,$search_id);
            }
            if($request->employee_name){ //employee name
                $search_name=['employee_name','like',$request->employee_name.'%'];
                array_push($search_data,$search_name);
            }
             $limit=(int)env('limit'); //number of paginate limit per page
             $employee=Employee::with('department','position')->withTrashed()->where($search_data)->paginate($limit);
             return $employee;

              

}

      /** 
    *@Decription-> export file employees table and emp_dep_position
    *@author-> nyi nyi aung
    *@date->28/08/2020
    *@param->$request
    *@return->$search_data->excel download
    */
    public function fileExport(Request $request){

        // Artisan::call('cache:clear'); //cache clear 
        // Artisan::call('config:cache'); //cache clear

        $search_data=[];
        if($request->id){ //ss
            $search_id=['employees.id',$request->id];
            array_push($search_data,$search_id);
        }
        if($request->employee_name){
            $search_name=['employees.employee_name','like',$request->employee_name.'%'];
            array_push($search_data,$search_name);
        }
    
     return Excel::download(new EmployeesExport($search_data), 'EmployeeNyiAung.xlsx');


    // $employee = Employee::where('id',$id)->get();
    // Excel::create('Laravel Excel', function($excel) use ($employee) {

    //         $excel->sheet('Excel sheet', function($sheet) use ($employee) {
    //         $sheet->loadView('contents.assessment_details')->with('assessment',$employee);
    //         $sheet->setOrientation('landscape');
    //     });
    // })->export('xls');
  
    }


        public function fileImport(){
        
        // Excel::import(new EmployeesImport, $request->file('file')->store('temp')); 
        // return back();
    }
}
