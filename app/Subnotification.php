<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subnotification extends Model
{
    public $timestamps = false;

    protected $guarded = [];
    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function notification()
    {
        return $this->belongsTo(DatabaseNotification::class, 'notification_id');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }
}
