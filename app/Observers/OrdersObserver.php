<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Dashboard_log;
use App\Order;

class OrdersObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the order "updated" event.   **/
    public function updated(Order $order)
    {
        // search for changes
        foreach ($order->getChanges() as $attribute => $new_value) {

            $order_old_status = $order->getOriginal('status');
            if ($attribute != 'updated_at' && $attribute != 'admin_id') {
                if($attribute == 'status' && $order_old_status == 'waiting') {
                    Dashboard_Log::create([
                        'admin_id' => Auth::guard('admin')->user()->id,
                        'log' => 'Order accepted by ('.Auth::guard('admin')->user()->name.')',
                    ]);
                }

                Dashboard_Log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'order  '.$attribute.' updated to '.$new_value,
                ]);
            }
        }
    }

}
