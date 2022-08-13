<?php

namespace App\Notifications;

use App\Notifications\channels\SubNotificationChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['database'];
        return [SubNotificationChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->order->id,
            'title' => 'new order is set',
            'description' => 'New order wsiting for accept now !',
            'link' => url('dashboard/orders', ['id' => $this->order->id]),
        ];
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
