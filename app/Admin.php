<?php

namespace App;

use App\Traits\HasSubNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasSubNotification;

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function dashboard_logs()
    {
        return $this->hasMany(Dashboard_log::class);
    }
    
    public function scopeActive($query) {
        return $query->where('status', 'active');
    }

    public function scopeSearch($query, $name) {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeRole($query,$type) {
        return $query->when($type, function ($query) use ($type) {
                    if($type == 'admin') {
                        $query->where('role', 'admin');
                    }
                    elseif($type == 'editor') {
                        $query->where('role', 'editor');
                    }
                });
    }
}
