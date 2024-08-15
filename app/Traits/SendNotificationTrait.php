<?php

namespace App\Traits;


use Illuminate\Support\Facades\Http;

trait SendNotificationTrait
{
    public function PushNotify($fcmnotification)
    {
        $fcmurl = config('firebase.firebase_url');
        $fcmserverKey = config('firebase.firebase_server_key');

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $fcmserverKey,
            'Content-Type' => 'application/json',
        ])->post($fcmurl, $fcmnotification);

        // Log or check the status and response
        if ($response->failed()) {
            return [
                'error' => true,
                'status' => $response->status(),
                'message' => $response->body(),
            ];
        }

        return $response->json();
    }

}
