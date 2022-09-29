<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Traits\WishlistOptions;
use App\Product;
use App\Wishlist_item;

class Page extends Component
{
    use WishlistOptions;
    public $wishlist_items;

    public function mount() {
        $this->wishlist_items = Auth::check() 
        ? Wishlist_item::Where('user_id', Auth::user()->id)->get()
        : Cart::instance('wishlist')->content();
    }

    //remove product from wishlist
    public function product_quantity($prod_id)
    {
        $product = Product::findOrFail($prod_id);
        return $product->quantity;
    }

    //remove product from wishlist
    public function remove($row_id)
    {
        Auth::check() ? $this->RemoveFromWishlistDatabase($row_id) : $this->RemoveFromWishlistSession($row_id);
    }

    //remove all products from wishlist
    public function clear()
    {
        Auth::check() ? $this->ClearWishlistDatabase() : $this->ClearWishlistSession();
    }

    public function render()
    {
        $this->wishlist_items = Auth::check() 
        ? Wishlist_item::Where('user_id', Auth::user()->id)->get()
        : Cart::instance('wishlist')->content();
            
        return view('livewire.frontend.wishlist.page');
    }
}