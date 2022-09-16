<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['image', 'title','subtitle','order','status','link'];

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }
}
