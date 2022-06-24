<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'image', 'name', 'email', 'password', 'role', 'status', 'hash'
    ];

    protected $hidden = [
        'password', 'remember_token', 'hash'
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'email_verified_at'
    ];

    public function dashboard_logs()
    {
        return $this->hasMany(Dashboard_log::class);
    }
    
}
