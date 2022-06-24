<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Admin;
use App\Setting;

class newEditorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $editor, $temp_pass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $editor, $temp_pass)
    {
        $this->editor = $editor;
        $this->temp_pass = $temp_pass;
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
             ->subject('your account are active now')
             ->view('emails.newEditor');
    }
}
