<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Category;
use App\Product;
use App\Product_image;
use Illuminate\Support\Facades\Session;
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
    public function addToCart(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $image = url(Product_image::ProductMainImage($product->id));
        $cart_item = Cart::instance('cart')->content()->where('id', $product->id)->first();
        if($request->input('qty')) {
            $quantity = $request->input('qty');
        }
        else {
            $quantity = 1 ;
        }

        if($cart_item) {
            if(($quantity + $cart_item->qty) > $product->quantity) {
                Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
            }
            else {
                Cart::instance('cart')->update($cart_item->rowId, ($quantity + $cart_item->qty));
            }
        }
        else {
            if($quantity <= $product->quantity) {
                Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $quantity,
                    'price' => $product->price,
                    'weight' => 0,
                    'options' => ['image' => $image]
                ]);
            }
        }

        return Redirect::back();
    }

    //upadte product quantity in cart by livewire shoppin-cart 
    //remove from cart in livewire shoppin-cart 

}
