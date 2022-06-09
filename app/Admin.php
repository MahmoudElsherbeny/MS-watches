<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Hash;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'role', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dashboard_logs()
    {
        return $this->hasMany(Dashboard_log::class);
    }

    //password hash
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    
}
