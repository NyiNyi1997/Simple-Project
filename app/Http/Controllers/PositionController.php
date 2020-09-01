<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

/** 
*@Description ->show,insert,update,delete,forceDelete form positions
*@author ->Nyi Nyi Aung
*@date ->26/8/2020
*/

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**  
    *@Decription-> show position data with paginate 
    *@author-> nyi nyi aung
    *@date->28/08/2020
    *@return $position
    */
    public function index()
    {
        //

        $limit=(int)env('limit');//number of paginate limit per page
        $position=Position::paginate($limit);
        return $position;

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
    *@Decription-> store  data to position table
    *@author-> nyi nyi aung
    *@param->$request
    *@date->26/08/2020
    */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'position_name' => 'required|max:20',
            'position_rank' => 'required|max:20',
        ]);

        $position = new Position();
        $position->position_name = $request['position_name'];
        $position->position_rank = $request['position_rank'];
        $position->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**  
    *@Decription->show data form position
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param->$id
    *@return->$position
    */
    public function show($id)
    {
        //
        $position=Position::where('id',$id)->get();
        return $position;
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
    *@Decription-> update  data position table
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param $request,$id
    *@return true
    */

    public function update(Request $request, $id)
    {
        //
        $position=Position::whereId($id)->firstOrFail();
        $position->position_name=$request->position_name;
        $position->position_rank=$request->position_rank;
        $position->update();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

       /**
    *@Description-> delete  data position table 
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param->$id
    */
    public function destroy($id)
    {
        //
        try{

        $position=Position::whereId($id)->firstOrFail();
        $position->delete();

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
    *@Description->force delete  data position table 
    *@author-> nyi nyi aung
    *@date->26/08/2020
    *@param->$id
    */
    public function forceDelete($id){

        try{

        $position=Position::withTrashed()->whereId($id)->firstOrFail();
        $position->forcedelete();

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
