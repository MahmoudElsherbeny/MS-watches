<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard_log extends Model
{

    public $timestamps = false;
    protected $dates = ['date'];

    protected $fillable = [
        'admin_id', 'log'
    ];

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
