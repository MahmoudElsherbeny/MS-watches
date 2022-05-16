<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Product;
use Illuminate\Http\Request;

class ShoppingCart extends Component
{
    public $cart_items;
    public $quantity = [];

    public function mount() {
        $this->cart_items = Cart::instance('cart')->content();
    }

     //update product quantity in cart
     public function prod_price($prod_id)
     {
         $product = Product::findOrFail($prod_id);
         return $product->price;
     }
 
    //update product quantity in cart
    public function updateCart($row_id, $value)
    {
        Cart::instance('cart')->update($row_id, $value);
        
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
