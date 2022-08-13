<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //function index - show orders page and orders live search
    public function index()
    {
        return view('backend.orders.list');
    }

    //function show - show order detailes page
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $editor_open_orders = Auth::guard('admin')->user()->orders
                                  ->where('status', '!=', 'completed')
                                  ->where('status', '!=', 'cancel');

        return view('backend.orders.show')->with(['order' => $order, 'open_orders' => $editor_open_orders]);
    }

    //function accept - accept order by editor
    public function accept_order($id, $editor_id)
    {
        $order = Order::findOrFail($id);
        $editor_open_orders = Auth::guard('admin')->user()->orders
                                  ->where('status', '!=', 'completed')
                                  ->where('status', '!=', 'cancel');
        if(count($editor_open_orders) <= 2) {
            $order->admin_id = $editor_id;
            $order->status = 'preparing';
            $order->save();
        }

        return view('backend.orders.show')->with('order', $order);
    }

}
