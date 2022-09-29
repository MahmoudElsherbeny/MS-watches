<?php

namespace App\Observers;

use App\Product_review;
use App\Product;

class ProductReviewObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the product review "created" event.   **/
    public function created(Product_review $review)
    {
        //store product average rates in (product) when review created
        $prod_exist = Product::Where('id', $review->product_id)->first();
        if ($prod_exist) {
            $prod_exist->rate = Product_review::getProductRate($review->product_id);
            $prod_exist->save();
        }
    }

    /**   Handle the product review "updated" event.   **/
    public function updated(Product_review $review)
    {
        //store product average rates in (product) when review updated
        $prod_exist = Product::Where('id', $review->product_id)->first();
        if ($prod_exist) {
            $prod_exist->rate = Product_review::getProductRate($review->product_id);
            $prod_exist->save();
        }
    }

    /**   Handle the product review "deleted" event.   **/
    public function deleted(Product_review $review)
    {
        //store product average rates in (product) when review deleted
        $prod_exist = Product::Where('id', $review->product_id)->first();
        if ($prod_exist) {
            $prod_exist->rate = Product_review::getProductRate($review->product_id);
            $prod_exist->save();
        }
    }

}
