<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class ShoppingCart extends Component
{
    public $cart_items;
    public $quantity = 1;

    public function mount() {
        $this->cart_items = Cart::instance('cart')->content();
    }

    //update product quantity in cart
    public function update($row_id)
    {
        Cart::instance('cart')->update($row_id, $this->quantity);
    }

    //remove product from cart
    public function remove($row_id)
    {
        Cart::instance('cart')->remove($row_id);
        if(Cart::instance('cart')->count() == 0) {
            Cart::instance('cart')->destroy();
        }
    }

    //remove all products from cart
    public function clear()
    {
        Cart::instance('cart')->destroy();
    }

    public function render()
    {
        $this->cart_items = Cart::instance('cart')->content();

        return view('livewire.frontend.shopping-cart');
    }
}
