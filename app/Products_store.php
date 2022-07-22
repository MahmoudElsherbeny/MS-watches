<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_store extends Model
{
    protected $fillable = [
        'product_id', 'admin_id', 'quantity', 'unit_price', 'total'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
