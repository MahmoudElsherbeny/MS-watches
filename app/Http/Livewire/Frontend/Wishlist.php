<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class Wishlist extends Component
{
    public $wishlist_items;

    public function mount() {
        $this->wishlist_items = Cart::instance('wishlist')->content();
    }

    //remove product from wishlist
    public function remove($row_id)
    {
        Cart::instance('wishlist')->remove($row_id);
        if(Cart::instance('wishlist')->count() == 0) {
            Cart::instance('wishlist')->destroy();
        }
    }

    //remove all products from wishlist
    public function clear()
    {
        Cart::instance('wishlist')->destroy();
    }

    public function render()
    {
        $this->wishlist_items = Cart::instance('wishlist')->content();

        return view('livewire.frontend.wishlist');
    }
}
