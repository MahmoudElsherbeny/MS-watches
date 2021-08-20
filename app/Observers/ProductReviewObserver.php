<?php

namespace App\Observers;
use App\Product_review;
use App\Product_avg_rate;

class ProductReviewObserver
{
    
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the product "created" event.   **/
    public function created(Product_review $review)
    {
        //store product average rates in (product_avg_rates) when review created
        $prod_exist = Product_avg_rate::Where('product', $review->product)->first();
        if (!$prod_exist) {
            Product_avg_rate::create([
                'product' => $review->product,
                'avg_rate' => Product_review::getProductRate($review->product),
            ]);
        }
        else {
            $prod_exist->avg_rate = Product_review::getProductRate($review->product);
            $prod_exist->save();
        }
    }

    /**   Handle the product "updated" event.   **/
    public function updated(Product $product)
    {
        
    }

}
