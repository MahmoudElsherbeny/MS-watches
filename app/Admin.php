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

    //password hash
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    //get user name
    static public function getAdminName($id) {
        $admin = Self::find($id);
        if($admin) {
            return $admin->name;
        }
        else {
            return 'Not Found';
        }
    }

    //get user role
    static public function getAdminRole($id) {
        $admin = Self::find($id);
        if($admin) {
            return $admin->role;
        }
        else {
            return 'Not Found';
        }
    }
}
