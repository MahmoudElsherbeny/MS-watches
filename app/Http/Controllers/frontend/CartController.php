<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function cart() {
        return view("frontend.pages.cart");
    }
    
    //add to cart function - add products in cart using session whatever user login or not
    public function addToCart($product_id, $quantity = 1)
    {
        $product = Product::findOrFail($product_id);
        $cart = Session::get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $product_id => [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->sale > 0 ? $product->sale : $product->price,
                    "image" => url(Product_image::ProductMainImage($product_id))
                ]
            ];
            Session::put('cart', $cart);

            return Redirect::back();
        }

        // if cart not empty then check if this product exists and increment quantity
        if(isset($cart[$product_id])) {

            $cart[$product_id]['quantity']++;
            Session::put('cart', $cart);

            return Redirect::back();
        }
        
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product_id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->sale > 0 ? $product->sale : $product->price,
            "image" => url(Product_image::ProductMainImage($product_id))
        ];
        Session::put('cart', $cart);

        return Redirect::back();
    }

    //remove from cart function - remove product from cart using session
    public function remove($product_id)
    {
        $cart = Session::get('cart');
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            if(!$cart) {
                Session::forget('cart');
            }
            else {
                Session::put('cart', $cart);
            }
        }

        return Redirect::back();
    }

     //checkout page function - display checkout page
     public function checkout_page()
     {
        return view("frontend.pages.checkout");
     }

}
