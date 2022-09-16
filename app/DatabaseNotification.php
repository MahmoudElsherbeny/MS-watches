<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseNotification extends Model
{
    protected  $table = 'notifications';

    protected $casts = [
        'data' => 'array',
    ];
    
    public function subnotificationts()
    {
        return $this->hasMany(Subnotification::class);
    }

}
