<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_avg_rate extends Model
{
    protected $fillable = ['product', 'avg_rate'];

    //get average of users rate for a product
    static public function getProductRate($id) {
        $rate = Self::Where('product',$id)->first();
        $prod_rate = $rate ? $rate->avg_rate : 0;
        return $prod_rate;
    }

}
