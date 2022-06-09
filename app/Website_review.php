<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website_review extends Model
{
    
    protected $fillable = ['product_review_id', 'status'];

    public function product_review()
    {
        return $this->belongsTo(Product_review::class, 'product_review_id');
    }

}
