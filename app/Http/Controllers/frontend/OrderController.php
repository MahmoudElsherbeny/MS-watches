<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\State;
use App\Category;
use App\Order;
use App\Order_item;
use App\Order_log;
use App\Product;
use App\User;
use App\User_info;
use View;

class OrderController extends Controller
{
    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //checkout page function - display checkout page
    public function checkout()
    {
       if(Cart::instance('cart')->count()) {
           $user = Auth::user();
           $states = State::OrderBy('state')->get();
           $cart = Cart::instance('cart')->content();
           return view("frontend.pages.checkout")->with(['user' => $user, 'states' => $states, 'cart_items' => $cart]);
       }
       else {
           return Redirect::back();
       }
    }

    //confirm order function - confirm order data
    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|min:11|numeric',
            'state' => 'required',
            'city' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'address' => 'required'
        ]);
        
        $user = User::find(Auth::user()->id);
        $cart = Cart::instance('cart');
        try {
            if($cart->count() > 0) {
                DB::transaction(function () use($user, $cart, $request) {
                    //chek if there user info to use it or update with new if not use new as user info
                    if($user->user_info) {
                        //add order data into database
                        $order = $this->createOrder($user->id,$user->name,$request->input('phone'),$request->input('state'),$request->input('city'),$request->input('address'),'waiting',$cart->subtotalfloat());
                    }
                    else {
                        $user_data = User_info::create([
                            'user_id' => $user->id,
                            'phone' => $request->input('phone'),
                            'state_id' => $request->input('state'),
                            'city' => $request->input('city'),
                            'address' => $request->input('address'),
                        ]);

                        //add order data into database
                        $order = $this->createOrder($user->id, $user->name, $user_data->phone, $user_data->state_id, $user_data->city, $user_data->address, 'waiting', $cart->subtotalfloat());
                    }

                    //store order items
                    foreach($cart->content() as $item) {
                        Order_item::create([
                            'order_id' => $order->id,
                            'product_id' => $item->id,
                            'price' => $item->price,
                            'quantity' => $item->qty,
                        ]); 

                        Product::find($item->id)->decrement('quantity', $item->qty);
                    }

                    $cart->destroy();

                    return route('UserOrder.detailes', ['id' => $order->id, 'name' => $user->name, 'user' => $user->id]);
                });
            }

        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //order detailes function - display order data detailes
    public function order_detailes($id,$name,$user_id)
    {

        $user = User::find($user_id);
        $order = Order::Where(['id' => $id, 'user_id' => $user->id])->first();
        if($order) {
            return view("frontend.pages.order_detailes")->with(['user' => $user, 'order' => $order]);
        }
        else {
            return abort('404');
        }

    }

    //cancel order function - cancel order by user if it not delivering yet
    public function cancel($id,$name,$user_id)
    {
        $user = User::find($user_id);
        $order = Order::Where(['id' => $id, 'user_id' => $user->id])->first();
        if($order && $order->status == 'waiting' || $order->status == 'preparing') {
            $order->status = 'cancel';
            $order->save();

            foreach($order->order_items as $item) {
                Product::find($item->product_id)->increment('quantity', $item->quantity);
            }

            Order_log::create([
                'order_id' => $order->id,
                'user' => Auth::user()->id,
                'user_type' => 'user',
                'log' => 'Order status updated to '.$order->status,
            ]);
        }

        return Redirect::back();
    }


    private function createOrder($user, $name, $phone, $state, $city, $address, $status, $total) {
        $order = Order::create([
            'user_id' => $user,
            'name' => $name,
            'phone' => $phone,
            'state_id' => $state,
            'city' => $city,
            'address' => $address,
            'status' => $status,
            'total' => $total,
        ]);

        return $order;
    }

}
