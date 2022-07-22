<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Admin;
use App\Setting;

class resetEditorPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $editor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $editor)
    {
        $this->editor = $editor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail_from = Setting::getSettingValue('email');
        $this->from($mail_from)
             ->subject('Reset your Password')
             ->view('emails.resetEditorPassword');
    }
}
