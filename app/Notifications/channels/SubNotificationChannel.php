<?php
namespace App\Notifications\channels;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class SubNotificationChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed                                  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        static $map = [];

        $notificationId = $notification->id;

        // get notification data
        $data = $this->getData($notifiable, $notification);

        // calculate hash
        $hash = md5(json_encode($data));

        // if hash is not in map - create parent notification record
        if (!isset($map[$hash])) {
            // create original notification record with empty notifiable_id
            DatabaseNotification::create([
                'id'              => $notificationId,
                'type'            => get_class($notification),
                'notifiable_id'   => 0,
                'notifiable_type' => get_class($notifiable),
                'data'            => $data,
                'read_at'         => null,
            ]);

            $map[$hash] = $notificationId;
        } else {
            // otherwise use another/first notification id
            $notificationId = $map[$hash];
        }

        // create subnotification
        $notifiable->subnotifications()->create([
            'notification_id' => $notificationId,
            'read_at'         => null
        ]);
    }

    /**
     * Prepares data
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return mixed
     */
    public function getData($notifiable, Notification $notification)
    {
        return $notification->toDatabase($notifiable);
    }
}