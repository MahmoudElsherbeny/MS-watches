<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $subj, $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$subject,$message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subj = $subject;
        $this->msg = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->name)
                    ->view('emails.contact');
    }
}
