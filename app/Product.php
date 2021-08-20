<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category', 'mini_description', 'description', 'price', 'sale', 'body_color', 'mina_color', 'status', 'published_by',
    ];

}
