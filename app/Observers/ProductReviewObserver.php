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

    /**   Handle the product "created" event.   **/
    public function created(Product_review $review)
    {
        //store product average rates in (product) when review created
        $prod_exist = Product::Where('id', $review->product)->first();
        if ($prod_exist) {
            $prod_exist->rate = Product_review::getProductRate($review->product);
            $prod_exist->save();
        }
    }

    /**   Handle the product "updated" event.   **/
    public function updated(Product $product)
    {
        
    }

}
