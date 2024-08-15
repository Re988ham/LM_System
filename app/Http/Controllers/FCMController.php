<?php

namespace App\Http\Controllers;



use App\Services\GeneralServices\NotificationService;
use Illuminate\Http\Request;

class FCMController extends Controller
{

    public NotificationService $notificationService;

    public function __construct(NotificationService $notificationService){

        $this->notificationService = $notificationService;

    }
    public function sendWebNotification(Request $request){

        $request->validate([
            'token'=>'required|string',
            'title'=>'required|string',
            'body'=>'required|string',
            'data'=>'nullable|string',
        ]);

        $token=$request->input('token');
        $title=$request->input('title');
        $body=$request->input('body');
        $data=$request->input('data',[]);

        $this->notificationService->send($token, $title, $body, $data);

        return response()->json(['message'=>'Notification sent successfully ']);
    }
}
