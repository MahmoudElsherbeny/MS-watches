<?php

namespace App\Http\Livewire\Backend\Order;

use App\Order_log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Product;


class OrderStatus extends Component
{
    public $order;
    public $status = 'waiting';

    public function mount($order) {
        $this->order = $order;
        $this->status = $this->order->status;
    }

    //order status function - change order status depending on order process
    public function order_status() {

        if($this->order) {
            if(Auth::guard('admin')->user()->role == 'admin') {
                //check if admin cancel order or live it again to updated order products quantity
                if($this->order->status == 'cancel' && $this->status != 'cancel') {
                    foreach($this->order->order_items as $item) {
                        Product::find($item->product_id)->decrement('quantity', $item->quantity);
                    }
                }
                elseif($this->order->status != 'cancel' && $this->status == 'cancel') {
                    foreach($this->order->order_items as $item) {
                        Product::find($item->product_id)->increment('quantity', $item->quantity);
                    }
                }
                $this->order->status = $this->status;
            }
            else {
                if($this->order->status != 'completed' && $this->order->status != 'cancel') {
                    $this->order->status = $this->status;
                }
            }
            if($this->order->isDirty()) {
                $this->order->save();
            }

            Order_log::create([
                'order_id' => $this->order->id,
                'user' => Auth::guard('admin')->user()->id,
                'user_type' => Auth::guard('admin')->user()->role,
                'log' => 'Order status updated to '.$this->order->status,
            ]);
        }

        $this->emit('status_change');

        //logs stored when updated by ProductObserver in app\observers
    }

    public function render()
    {
        return view('livewire.backend.order.order-status');
    }
}
