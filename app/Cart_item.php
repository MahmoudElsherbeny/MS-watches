<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart_item extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'name', 'qty', 'price', 'options',
    ];

    protected $casts = ['options' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    static public function total($cart_items) {
        $total = 0;
        foreach($cart_items as $item) {
            $total += $item->price * $item->qty;
        }

        return $total;
    }
}
