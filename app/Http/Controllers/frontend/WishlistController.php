<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Product;
use App\Product_image;

use Redirect;

class WishlistController extends Controller
{
    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //show wishlist page function
    public function index() {
        return view("frontend.pages.wishlist");
    }

    //add to wishlist function - add products in wishlist using session whatever user login or not
    public function addToWishlist($product_id)
    {
        $product = Product::findOrFail($product_id);
        $image = url(Product_image::ProductMainImage($product_id));

        $wishlist = Cart::instance('wishlist');

            $wishlist->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'weight' => 0,
                'options' => ['image' => $image]
            ]);

        return Redirect::back();
    }

}
