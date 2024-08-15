<?php

namespace App\Services\GeneralServices;


use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationService
{

    protected \Kreait\Firebase\Contract\Messaging $messaging;

    public function __construct()
    {
        $serviceAccountPath = storage_path('app/learningapp-6f15a-a94d1d94ac73.json');

        // Initialize the Firebase Factory with the service account
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);

        // Create the Messaging instance
        $this->messaging = $factory->createMessaging();
    }
//    public function index()
//    {
//        return auth()->user()->notifications;
//    }


    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function send( //$token,
                         $title, $body, $data = []): void
    {   $token='f-2vEzDHRMCnt9KgPo5tnP:APA91bETRO_3ty6ZG5bPH5Zs5-bc_MEA5tkGlp02WgPo9Z38aqksEQIh34Adlr2q9JzJDS1N4zJTqix50EQWQvHO4sAKzgJXBJb8Db5I6doPLHYf3maGTAk1u6WUY82SA8nuLibFrrHn';
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(['title' => $title, 'body' => $body])
            ->withData($data);
        $this->messaging->send($message);
    }
}
//    public function markAsRead($notificationId): bool
//    {
//        $notification = auth()->user()->notifications()->findOrFail($notificationId);
//
//        if(isset($notification)) {
//            $notification->markAsRead();
//            return true;
//        }else return false;
//    }
//
//    public function destroy($id): bool
//    {
//        $notification = auth()->user()->notifications()->findOrFail($id);
//
//        if(isset($notification)) {
//            $notification->delete();
//            return true;
//        }else return false;
//    }
//
//}
