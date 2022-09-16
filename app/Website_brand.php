<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website_brand extends Model
{
    protected $fillable = ['name', 'image', 'link', 'status'];

    public function scopeActive($query) {
        return $query->where('status', 'active');
    }

}
