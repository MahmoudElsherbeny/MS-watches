<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Product;
use App\Traits\WishlistOptions;
use App\Wishlist_item;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class Page extends Component
{
    use WishlistOptions;
    public $wishlist_items;

    public function mount() {
        Auth::check() ?
            $this->wishlist_items = Wishlist_item::Where('user_id', Auth::user()->id)->get()
        :
            $this->wishlist_items = Cart::instance('wishlist')->content();
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
        Auth::check() ?
            $this->wishlist_items = Wishlist_item::Where('user_id', Auth::user()->id)->get()
        :
            $this->wishlist_items = Cart::instance('wishlist')->content();
            
        return view('livewire.frontend.wishlist.page');
    }
}
