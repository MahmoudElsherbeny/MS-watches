<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category', 'mini_description', 'description', 'price', 'sale', 'body_color', 'mina_color', 'tags', 'status', 'published_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function published_by()
    {
        return $this->belongsTo(Admin::class, 'published_by', 'id');
    }

    //get products 
    static public function getSaleProducts($condition,$orderby,$limit) {
        $products = Self::Where('status','active')
                    ->Where('sale',$condition,0)
                    ->OrderBy($orderby,'DESC')->limit($limit)->get();   
        return $products;
    }

}
