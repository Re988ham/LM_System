<?php

namespace App\Services\Application\LivesWedget;



use App\Models\Live;
use App\Models\Specialization;
use App\Models\User;
use App\Services\GeneralServices\NotificationService;
use App\Traits\FCMNotification;
use Carbon\Carbon;

class LiveService
{
    use FCMNotification;
    /**
     Service for manage Lives operations in the system.
    */

    public function createlive($data){
      $data['user_id'] = Auth()->user()->id;
      $live =Live::create($data);
        $user_name=User::find($data['user_id']);
        $notificationService = new NotificationService();
        $notificationService->send('EDUspark', "{$user_name->name} scheduled a new live");
//         $this->dispatchNotification('EDUspark', "{$user_name->name} scheduled a new live ",['title'=>"{$live->title}",'in'=>"{$live->data_start}",'at'=>"{$live->time_start}"]);
       // dd($live->time_start);

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
