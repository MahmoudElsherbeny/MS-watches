<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\channels\SubNotificationChannel;
use App\Admin;

class StateNotification extends Notification
{
    use Queueable;
    private $user_id;
    private $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_id,$action)
    {
        $this->user_id = $user_id;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail'];
        return [SubNotificationChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'update states',
            'description' => 'State '.$this->action.' by '.Admin::find($this->user_id)->name.' !',
            'link' => url('dashboard/states'),
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
