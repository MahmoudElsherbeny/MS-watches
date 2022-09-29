<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Dashboard_log;

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
                'admin_id' => Auth::guard('admin')->user()->id,
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
                    'admin_id' => Auth::guard('admin')->user()->id,
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
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete product '.$product->name,
        ]);
    }

    /**   Handle the product "restored" event.   **/
    public function restored(Product $product)
    {
        //
    }

    /**   Handle the product "force deleted" event.   **/
    public function forceDeleted(Product $product)
    {
        //
    }

}
