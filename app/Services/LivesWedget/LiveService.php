<?php

namespace App\Services\LivesWedget;



use App\Models\Live;
use Carbon\Carbon;

class LiveService
{
    /**
     Service for manage Lives operations in the system.
    */

    public function createlive($data){
      $data['user_id'] = Auth()->user()->id;
      $live =Live::create($data);

      return $live;
    }

    public function getlives(){
        return Live::where('date_start','>=',carbon::now()->toDateString())
             ->where('time_start','>=',carbon::now()->toDateString())
             ->get();
    }

}
