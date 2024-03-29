<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Traits\WishlistOptions;
use App\Category;
use App\Product;
use App\Website_brand;

class WishlistController extends Controller
{
    use WishlistOptions;

    protected $categories, $brands;

    public function __construct() {
        $this->categories = Category::Active()->OrderBy('order')->get();
        $this->brands = Website_brand::Active()->OrderBy('id')->get();
        View::share([
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    //show wishlist page function
    public function index() {
        return view("frontend.pages.wishlist");
    }

    //add to wishlist function - add products in wishlist
    public function addToWishlist($product_id)
    {
        $product = Product::findOrFail($product_id);
        Auth::check() 
            ? $this->AddToWishlistDatabase($product->id, Auth::user()->id) 
            : $this->AddToWishlistSession($product->id); 

        return Redirect::back();
    }

    //add product to wishlist by livewire product/card
    //remove from wishlist in livewire wishlist/page
}