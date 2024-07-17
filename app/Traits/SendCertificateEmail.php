<?php

namespace App\Traits;

use App\Mail\CertificateEmail;
use Illuminate\Support\Facades\Mail;

trait SendCertificateEmail
{
    public function sendCertificate($data, $recipient)
    {
        Mail::to($recipient)->send(new CertificateEmail($data));
    }
}
