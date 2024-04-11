<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use PhpParser\Token;

trait SendNotificationTrait
{
     public function PushNotify(string $token ,string $title, string $Description):void
    {
        $SERVER_API_KEY = 'AAAAMaLCKd8:APA91bECJvfcxg8YZqDX9qAAkkc-qjc6hnU2OsMOgzkYdvYZLCusHK_WtnUsIx1H6byt1Xy3-Q-2avds_uZJgDqMPK4MNW0nZzJpQYN0dUG0B0CRJrz2JAkIB3_lficbOncNjiPf2j9l';

        $token_1=$token;

        $data = [

            "registration_ids" => [
                $token_1
            ],

            "notification" => [

                "title" => "{{$title}}",

                "body" => "{{$Description}}",

                "sound"=> "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
}
