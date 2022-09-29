<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Cart_item;

class Counter extends Component
{
    protected $listeners = ['update_cart' => 'render'];

    public function render()
    {
        $cart_counter = Auth::check()
        ? Cart_item::Where('user_id', Auth::user()->id)->get()->count()
        : Cart::instance('cart')->content()->count();
        
        return view('livewire.frontend.cart.counter')->with('cart_counter', $cart_counter);
    }
}
