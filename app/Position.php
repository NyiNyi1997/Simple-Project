<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Position extends Model
{
    //
    use softDeletes;

    public function Department(){
        return $this->belongsToMany('App\Department','emp_dep_positions','employee_id','department_id');
    }
    public function Employee(){
        return $this->belongsToMany('App\Employee','emp_dep_positions','employee_id','position_id');
    }
}
