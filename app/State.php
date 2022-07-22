<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    
    protected $fillable = ['state', 'delivery'];

    public function user_infos()
    {
        return $this->hasMany(User_info::class);
    }

    public function orders()
    {
        return $this->hasMany(State::class);
    }

}
