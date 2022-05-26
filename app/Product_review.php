<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    protected $fillable = ['user', 'product', 'review','rate'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }

    //get average of users rate for a product
    static public function getProductRate($id) {
        $reviews = Self::Where('product',$id)->get();
        $rate = 0;
        $product_rate = 0;
        foreach($reviews as $review) {
            $rate += $review->rate;
        }
        if(count($reviews) > 0) {
            $product_rate = $rate/count($reviews);
        }

        return $product_rate;
    }

    //get count of reviews for product
    static public function getReviewsCount($id) {
        $reviews = Self::Where('product',$id)->get();
        $count = count($reviews);
        
        return $count;
    }

    //check if user rate and review a product
    static public function userReviewCheck($product,$user) {
        $review = Self::Where('product',$product)->Where('user',$user)->first();
        return $review ? true:false;
    }

}
