<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Cart_item;
use App\Product;
use App\Traits\CartOptions;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Page extends Component
{
    use CartOptions;

    public $cart_items;
    public $quantity = [];

    public function mount() {
        Auth::check() ? $this->cart_items = Cart_item::Where('user_id', Auth::user()->id)->get() : $this->cart_items = Cart::instance('cart')->content();
        
        foreach($this->cart_items as $item) {
            $this->quantity[$item->id] = $item->qty;
        }
    }

    //update product quantity in cart
    public function prod_price($prod_id)
    {
        $product = Product::findOrFail($prod_id);
        return $product->price;
    }

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

    //update product quantity in cart
    public function updateCart($row_id, $quantity)
    {
        Auth::check() ? $this->UpdateCartDatabase($row_id, $quantity) : $this->UpdateCartSession($row_id, $quantity);
        $this->emit('update_cart');
    }

    //remove product from cart
    public function remove($row_id)
    {
        Auth::check() ? $this->RemoveFromCartDatabase($row_id) : $this->RemoveFromCartSession($row_id);
        $this->emit('update_cart');
    }

    //remove all products from cart
    public function clear()
    {
        Auth::check() ? $this->ClearCartDatabase() : $this->ClearCartSession();
        $this->emit('update_cart');
    }

    public function render()
    {   
        Auth::check() ? 
            $this->cart_items = Cart_item::Where('user_id', Auth::user()->id)->get() 
        : 
            $this->cart_items = Cart::instance('cart')->content();

        return view('livewire.frontend.cart.page')->with(['cart_total' => $this->total()]);
    }
}
