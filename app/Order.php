<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'state_id', 'city', 'address', 'status', 'total', 'delivery', 'admin_id'];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }

    public function order_logs()
    {
        return $this->hasMany(Order_log::class)->orderBy('date','DESC');
    }

}
