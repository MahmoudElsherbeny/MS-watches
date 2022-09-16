<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

use App\Cart_item;

class Sidemenu extends Component
{
    protected $listeners = ['update_cart' => 'render'];

    public function total() {
        if(Auth::check()) {
            $items = Cart_item::Where('user_id', Auth::user()->id)->get();
            $total = Cart_item::total($items);
        }
        else {
            $total = Cart::instance('cart')->subtotalfloat();
        }

        return $total;
    }

    public function render()
    {
        if(Auth::check()) {
            $cart = Cart_item::Where('user_id', Auth::user()->id)->get();
        }
        else {
            $cart = Cart::instance('cart')->content();
        }

        return view('livewire.frontend.cart.sidemenu')->with(['cart_items' => $cart, 'cart_total' => $this->total()]);
    }
}
