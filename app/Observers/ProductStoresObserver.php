<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Dashboard_log;
use App\Products_store;

class ProductStoresObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the Products_store "created" event.   **/
    public function created(Products_store $product_store)
    {
        //store logs when product_store created
        if ($product_store->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'add new product ('.$product_store->product->name.') quantity ('.$product_store->quantity.')',
            ]);
        }
    }

    /**   Handle the Products_store "updated" event.   **/
    public function updated(Products_store $product_store)
    {
        // search for changes
        foreach ($product_store->getChanges() as $attribute => $new_value) {
            if ($attribute != 'admin_id' && $attribute != 'updated_at') {
                if($attribute == 'unit_price' || $attribute == 'total') {
                    Dashboard_Log::create([
                        'admin_id' => Auth::guard('admin')->user()->id,
                        'log' => 'Update product ('.$product_store->product->name.') '.$attribute.' to £ '.$new_value/100 ,
                    ]);
                }
                else {
                    Dashboard_Log::create([
                        'admin_id' => Auth::guard('admin')->user()->id,
                        'log' => 'Update product ('.$product_store->product->name.') '.$attribute.' to '.$new_value ,
                    ]);
                }
            }
        }
    }

    /**   Handle the Products_store "deleted" event.   **/
    public function deleted(Products_store $product_store)
    {
        //store logs when state deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete product ('.$product_store->product->name.') store quantity ('.$product_store->quantity.')',
        ]);
    }
}
