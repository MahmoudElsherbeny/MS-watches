<?php

namespace App\Observers;

use App\Product;
use App\Dashboard_log;
use Auth;

class ProductObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the product "created" event.   **/
    public function created(Product $product)
    {
        //store logs when product created
        if ($product->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'user' => Auth::guard('admin')->user()->id,
                'log' => 'create new product '.$product->name,
            ]);
        }
    }

    /**   Handle the product "updated" event.   **/
    public function updated(Product $product)
    {
        // search for changes
        foreach ($product->getChanges() as $attribute => $new_value) {

            $product_name = $product->getOriginal('name');
            if ($attribute != 'updated_at') {
                Dashboard_Log::create([
                    'user' => Auth::guard('admin')->user()->id,
                    'log' => 'Update product '.$product_name.' '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the slide "deleted" event.   **/
    public function deleted(Product $product)
    {
        //store logs when product deleted
        Dashboard_log::create([
            'user' => Auth::guard('admin')->user()->id,
            'log' => 'Delete product '.$product->name,
        ]);
    }

    /**   Handle the category "restored" event.   **/
    public function restored(Category $category)
    {
        //
    }

    /**   Handle the category "force deleted" event.   **/
    public function forceDeleted(Category $category)
    {
        //
    }

}
