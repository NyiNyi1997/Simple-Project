<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PositionRegistrationValidationRequest;
use App\Repositories\Interfaces\PositionRepositoryInterfaces;

class PositionRegistrationController extends Controller
{
    //

    public function __construct(PositionRepositoryInterfaces $positionRepo)
    {       
        $this->positionRepo = $positionRepo;
    }
    
    public function save(PositionRegistrationValidationRequest $request)
    {
        
        $this->positionRepo->savePosition($request);
       
    } 
    
}

