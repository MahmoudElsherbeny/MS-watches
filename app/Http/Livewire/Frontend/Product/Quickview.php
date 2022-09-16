<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Traits\CartOptions;
use App\Traits\WishlistOptions;
use Illuminate\Support\Facades\Auth;

class Quickview extends Component
{
    use CartOptions, WishlistOptions;

    public $product;
    public $qty;

    public function mount() {
        $this->qty = 1;
    }

    //add to cart function - add products in cart
    public function addToCart() {
        Auth::check() ? $this->AddToCartDatabase(Auth::user(),$this->product, $this->qty) : $this->AddToCartSession($this->product, $this->qty);
        $this->emit('update_cart');
    }

    //add to wishlist function - add products in wishlist
    public function addToWishlist() {
        Auth::check() ? 
            $this->AddToWishlistDatabase($this->product->id, Auth::user()->id) 
        : 
            $this->AddToWishlistSession($this->product->id);
    }

    public function render()
    {
        return view('livewire.frontend.product.quickview');
    }
}
