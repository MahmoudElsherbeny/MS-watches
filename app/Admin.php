<?php

namespace App;

use App\Traits\HasSubNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements JWTSubject
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function dashboard_logs()
    {
        return $this->hasMany(Dashboard_log::class);
    }
    
}
