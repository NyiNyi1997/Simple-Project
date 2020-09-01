<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Employee extends Model
{
    //
    use softDeletes;
    
    
    public $fillable=['employee_name','email','dob','password','gender','department_id','position_id'];

   // public $fillable = ['employee_name', 'email', 'dob','password','gender'];

    // public function Emp_dep_position(){
    //     return $this->hasMany('App\Emp_dep_position');
    //     }
    public function Department(){
        return $this->belongsToMany('App\Department','emp_dep_positions','employee_id','department_id');
    }
    public function Position(){
        return $this->belongsToMany('App\Position','emp_dep_positions','employee_id','position_id');
    }
  
}
