<?php

namespace App\Services\Application\ChattingWedget;



use App\Models\User;

class ChattingService
{
    /**
     Service for manage chat operations in the system.
    */

    public function getusers(){
        $users = User::get();
        foreach($users as $user){

            $user['specializations'] = $user->specializations;

        }
        return $users;
    }

}
