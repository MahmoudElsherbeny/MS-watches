<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['product_id', 'image', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }
}
