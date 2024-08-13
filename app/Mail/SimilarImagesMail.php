<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SimilarImagesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $similarImages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($similarImages)
    {
        $this->similarImages = $similarImages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Similar Images Found')
            ->view('emails.similar_images')
            ->with('similarImages', $this->similarImages);
    }
}
