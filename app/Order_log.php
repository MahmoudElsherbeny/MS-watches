<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_log extends Model
{
    public $timestamps = false;
    protected $dates = ['date'];

    protected $fillable = [
        'order_id', 'user', 'user_type', 'log'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    //get user name depens on his type
    public function user_name($log_id)
    {
        $log_row = Self::find($log_id);
        if($log_row->user_type == 'user') {
            $user_name  = User::Where('id',$log_row->user)->first()->name;
        }
        else {
            $user_name  = Admin::Where('id',$log_row->user)->first()->name;
        }

        return $user_name;
    }

}
