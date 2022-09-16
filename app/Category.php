<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon','order','status'];

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }

    public function scopeSearch($query, $name) {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
