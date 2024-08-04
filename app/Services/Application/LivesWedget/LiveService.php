<?php

namespace App\Services\Application\LivesWedget;



use App\Models\Live;
use App\Models\Specialization;
use App\Models\User;
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
        $lives = Live::where('date_start','>=',carbon::now()->toDateString())
            ->where('time_start','>=',carbon::now()->toDateString())
            ->get();
        foreach ($lives as $live){
            $live['user']= User::find($live->user_id)->name;
            $live['specialization']= Specialization::find($live->specialization_id)->name;

        }
        return $lives;
    }

}
