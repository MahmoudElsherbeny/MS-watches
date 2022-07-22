<?php

namespace App\Http\Livewire\Backend\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use App\Order;
use App\Order_log;
use App\Product;

class Orderslist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $order_search;
    public $status;

    public function mount() {
        $this->status = 'waiting';
    }

    //order status function - change order status depending on order process
    public function order_status($id) {

        $order = Order::find($id);
        if($order) {
            if(Auth::guard('admin')->user()->role == 'admin') {
                //check if admin cancel order or live it again to updated order products quantity
                if($order->status == 'cancel' && $this->status != 'cancel') {
                    foreach($order->order_items as $item) {
                        Product::find($item->product_id)->decrement('quantity', $item->quantity);
                    }
                }
                elseif($order->status != 'cancel' && $this->status == 'cancel') {
                    foreach($order->order_items as $item) {
                        Product::find($item->product_id)->increment('quantity', $item->quantity);
                    }
                }
                $order->status = $this->status;
                $order->save();
            }
            else {
                if($order->status != 'completed' && $order->status != 'cancel') {
                    $order->status = $this->status;
                    $order->save();
                }
            }

            Order_log::create([
                'order_id' => $order->id,
                'user' => Auth::guard('admin')->user()->id,
                'user_type' => Auth::guard('admin')->user()->role,
                'log' => 'Order status updated to '.$order->status,
            ]);
        }

        //logs stored when updated by ProductObserver in app\observers
    }

    public function render()
    {
        $orders = Order::Where('name', 'like', '%'.$this->order_search.'%')
                        ->orWhere('phone', 'like', '%'.$this->order_search.'%')
                        ->orWhere('status', 'like', '%'.$this->order_search.'%')
                        ->OrderBy('created_at','DESC')->paginate(30);
        return view('livewire.backend.order.orderslist')->with('orders',$orders);
    }
}
