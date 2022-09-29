<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Traits\CartOptions;
use App\Traits\WishlistOptions;

class Card extends Component
{
    use CartOptions, WishlistOptions;

    public $product, $qty;

    public function mount() {
        $this->qty = 1;
    }

    public function render()
    {
        return view('livewire.frontend.product.card');
    }

    //add to cart function - add products in cart
    public function addToCart() {
        Auth::check() 
        ? $this->AddToCartDatabase(Auth::user(),$this->product, $this->qty) 
        : $this->AddToCartSession($this->product, $this->qty);

        $this->emit('update_cart');
    }

    //add to wishlist function - add products in wishlist
    public function addToWishlist() {
        Auth::check() 
        ? $this->AddToWishlistDatabase($this->product->id, Auth::user()->id) 
        : $this->AddToWishlistSession($this->product->id);
    }
}