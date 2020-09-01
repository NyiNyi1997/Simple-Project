<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Emp_dep_position extends Model
{
    //
    use softDeletes;

    public function Employee(){
        return $this->belongsToMany('App\Employee');
    }
    public function Position(){
        return $this->belongsTo('App\Position');
    }
    public function Department(){
        return $this->belongsTo('App\Department');
    
    }
}
