<?php

namespace App\Traits;

use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Jobs\SendFirebaseNotificationJob;

trait FCMNotification
{
    protected \Kreait\Firebase\Contract\Messaging $messaging;

    // Define the token as a constant
    protected const TOKEN = 'cFCIC9hEQGiqDRXxG-0YX9:APA91bF5rXFV17oxRaOR6T5lrorSypCfHEJWsvAhOGfA78qZEYOWA7oSjLrqu2RX7HilEqoBwdyprUUFESq5RvRzsqjinf4YiC5sUSa7bD4qxLSa28KwWuEfCZnwR50braEi75ExjPQL';
    public function initializeFirebase()
    {
        $serviceAccountPath = storage_path('app/learningapp-4736c-e9b4b11b72fc.json');

        // Initialize the Firebase Factory with the service account
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);

        // Create the Messaging instance
        $this->messaging = $factory->createMessaging();
    }

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function sendNotification(string $title, string $body): void
    {
        $this->initializeFirebase();

        $message = CloudMessage::withTarget('token', self::TOKEN)
            ->withNotification(['title' => $title, 'body' => $body]);
        //->withData($data);

        $this->messaging->send($message);
    }

    /**
     * Dispatch the notification job to the queue.
     */
    public function dispatchNotification(string $title, string $body): void
    {
        SendFirebaseNotificationJob::dispatch($title, $body, self::TOKEN);
    }
}
