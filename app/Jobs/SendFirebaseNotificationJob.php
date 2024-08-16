<?php

namespace App\Jobs;

use App\Services\GeneralServices\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;

class SendFirebaseNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $title;
    protected string $body;
//    protected array $data;
    protected string $token;

    /**
     * Create a new job instance.
     */
    public function __construct(string $title, string $body, string $token)
    {
        $this->title = $title;
        $this->body = $body;
//        $this->data = $data;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function handle()
    {
        $notificationService = new NotificationService();
        $notificationService->send($this->title, $this->body, $this->token);
    }
}
