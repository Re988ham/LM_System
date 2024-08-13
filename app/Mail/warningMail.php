<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class warningMail extends Mailable
{
    use Queueable, SerializesModels;

    public $testMailData;
    public $similarImages;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($testMailData,$similarImages)
    {
        $this->testMailData = $testMailData;
        $this->similarImages = $similarImages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('EDUspark')
            ->view('emails.testMail');
    }
}
