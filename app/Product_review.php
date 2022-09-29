<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'review','rate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function website_review()
    {
        return $this->hasOne(Website_review::class);
    }

    //get average of users rate for a product
    static public function getProductRate($id) {
        $reviews = Self::Where('product_id',$id)->get();
        $rate = 0;
        foreach($reviews as $review) {
            $rate += $review->rate;
        }
        $product_rate = count($reviews) > 0 ? $rate/count($reviews) : 0;

        return $product_rate;
    }

    //get count of reviews for product
    static public function getReviewsCount($id) {
        $reviews = Self::Where('product_id',$id)->get();
        return count($reviews);
    }

    //check if user rate and review a product
    static public function userReviewCheck($product,$user) {
        $review = Self::Where('product_id',$product)->Where('user_id',$user)->first();
        return $review ? true:false;
    }

}
