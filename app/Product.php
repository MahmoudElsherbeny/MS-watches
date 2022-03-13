<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category', 'mini_description', 'description', 'price', 'sale', 'body_color', 'mina_color', 'status', 'published_by',
    ];

    //get products 
    static public function getSaleProducts($condition,$orderby,$limit) {
        $products = Self::Where('status','active')
                    ->Where('sale',$condition,0)
                    ->OrderBy($orderby,'DESC')->limit($limit)->get();   
        return $products;
    }

}
