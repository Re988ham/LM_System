<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SendNotificationTrait;
use Illuminate\Support\Facades\Auth;


class testController extends Controller
{
    use SendNotificationTrait;
    public function index()
    {
            $to = auth::user()->getRememberToken();
            // Rest of your code...
            $this->PushNotify($to,'ssss','ddddddddd');
            dd($to);
    }
}
