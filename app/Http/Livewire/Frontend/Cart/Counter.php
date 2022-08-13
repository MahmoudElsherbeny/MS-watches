<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Cart_item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Counter extends Component
{
    protected $listeners = ['update_cart' => 'render'];

    public function render()
    {
        if(Auth::check()) {
            $cart_counter = Cart_item::Where('user_id', Auth::user()->id)->get()->count();
        }
        else {
            $cart_counter = Cart::instance('cart')->content()->count();
        }
        
        return view('livewire.frontend.cart.counter')->with('cart_counter', $cart_counter);
    }
}
