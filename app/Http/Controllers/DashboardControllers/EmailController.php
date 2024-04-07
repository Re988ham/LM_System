<?php

namespace App\Http\Controllers\DashboardControllers;


use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $testMailData = [
            'title' => 'EDUspark',
            'body' => 'hi.'
        ];

        Mail::to('mhranbadger@gmail.com')->send(new SendMail($testMailData));

        dd('Success! Email has been sent successfully.');
    }
}
