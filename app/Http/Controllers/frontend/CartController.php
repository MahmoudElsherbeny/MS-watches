<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Category;
use App\Product;
use App\Product_image;
use Redirect;
use Session;
use View;

class CartController extends Controller
{

    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //show cart page function
    public function index() {
        return view("frontend.pages.cart");
    }
    
    //add to cart function - add products in cart using session whatever user login or not
    public function addToCart($product_id, $quantity = 1)
    {
        $product = Product::findOrFail($product_id);
        $image = url(Product_image::ProductMainImage($product_id));

        Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $quantity,
                    'price' => $product->price,
                    'weight' => 0,
                    'options' => ['image' => $image]
                ]);

        return Redirect::back();
    }

    //upadte product quantity in cart by livewire shoppin-cart 
    //remove from cart in livewire shoppin-cart 
    

     //checkout page function - display checkout page
     public function checkout_page()
     {
        return view("frontend.pages.checkout");
     }

}
