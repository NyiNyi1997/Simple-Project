<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;

/** 
*@Description ->show,insert,update,delete,forceDelete form departments
*@author ->Nyi Nyi Aung
*@date ->26/8/2020
*/

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $limit=(int)env('limit');//number of paginate limit per page
        $department=Department::withTrashed()->paginate($limit);
        return $department;
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
    *@Description-> store  data from department table
    *@author-> nyi nyi aung
    *@param->$request
    *@date->26/08/2020
    */
    public function store(Request $request)
    {
        try{

        
        $data = $request->validate([
            'department_name' => 'required|max:20',
        ]);

        $department = new Department();
        $department->department_name = $request['department_name'];
        $department->save();

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
    *@Description-> show data from department table
    *@author-> nyi nyi aung
    *@param->$id
    *@date->27/08/2020
    *@return $department[]=department_id
    */
    public function show($id)
    {
        //
        try{
        $department=Department::where('id',$id)->get();

        return response()->json([
            'message'=>'Successful list'
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
    public function update(Request $request, $id)
    {
        //
        try{
        $department=Department::whereId($id)->firstOrFail();
        $department->department_name=$request->department_name;
        $department->update();

        return response()->json([
            'message'=>'Successful Update'
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
    public function destroy($id)
    {
        //
        // $department=Department::find($id);
        // $department->deleted_at=Carbon::now();
        // $department->save();
        // return "Successful";

        $department=Department::whereId($id)->firstOrFail();
        $department->delete();

    }

    public function forceDelete($id)
    {
        //
        try{
        $department=Department::withTrashed()->whereId($id)->firstOrFail();
        $department->forceDelete();

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
}
