<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $fillable = ['user_id', 'image', 'phone', 'state_id', 'city', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

}
