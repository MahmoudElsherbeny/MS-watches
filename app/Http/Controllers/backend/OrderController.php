<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Order;

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
        return view('backend.orders.show')->with('order', $order);
    }

}
