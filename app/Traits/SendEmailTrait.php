<?php

namespace App\Traits;

use App\Jobs\sendemail;
use App\Mail\SendCodeResetPassword;
use App\Mail\SendMail;
use App\Mail\warningMail;
use Illuminate\Support\Facades\Mail;
//use PharIo\Manifest\Email;
//use PharIo\Manifest\Email;

trait SendEmailTrait
{
    public function SendGreetingEmail(string $email): void
    {
        $testMailData = [
            'title' => 'EDUspark',
            'body' => 'Hi .your welcome in our app ?',
            'img-path' => "public/assets/app_img/logo_image.png"
        ];

        Mail::to($email)->queue(new SendMail($testMailData));

        //dd('Success! Email has been sent successfully.');

    }

    public function SendCodeEmail(string $email, string $code): void
    {
        Mail::to($email)->queue(new SendCodeResetPassword($code));

    }

//    public function SendWarningEmail(string $email, array $similarImages): void
//    {
//        $testMailData = [
//            'title' => 'EDUspark',
//            'body' => 'There is someone tried to make fuss',
//            'img-path' => storage_path('app/public/assets/app_img/warning.png') // Updated path to point to your uploaded image
//        ];
//
//        Mail::to($email)->send(new warningMail($testMailData, $similarImages));
//    }
}
