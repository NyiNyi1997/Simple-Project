<?php

namespace App\Repositories;


use App\Position;
use App\Repositories\Interfaces\PositionRepositoryInterfaces;
//use Your Model

/**
 * Class PositionRepository.
 */
class PositionRepository implements PositionRepositoryInterfaces
{
    /**
     * @return string
     *  Return the model
     */
   
        //return YourModel::class;

        public function savePosition($request)
        {
            $position = new Position();
            $position->position_name = $request['position_name'];
            $position->position_rank = $request['position_rank'];
            $position->save();
        }      
        
    }

