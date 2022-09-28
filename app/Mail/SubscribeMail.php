<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sport;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sport)
    {
        $this->sport = $sport;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscribe')->with('sport',$this->sport);
    }
}
