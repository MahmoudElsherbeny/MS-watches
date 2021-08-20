<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard_log extends Model
{

    public $timestamps = false;
    protected $dates = ['date'];

    protected $fillable = [
        'user', 'log'
    ];

    protected $guarded = [];

}
