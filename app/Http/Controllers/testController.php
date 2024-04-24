<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Models\User;
use App\Requests\Operations\SearchValidation;
use App\Services\ResponseService;
use App\Services\SearchService;
use App\Traits\SendNotificationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


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
