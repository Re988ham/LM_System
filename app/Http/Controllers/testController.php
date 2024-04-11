<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SendNotificationTrait;


class testController extends Controller
{
    use SendNotificationTrait;

    public function index()
    {
        $user = User::find(auth('sanctum')->id());
        $userToken = $user->getRememberToken();

//        return response()->json([
//            "token" => $userToken
//        ]);
        // Rest of your code...
        $this->PushNotify($userToken, 'ssss', 'ddddddddd');
    }
}
