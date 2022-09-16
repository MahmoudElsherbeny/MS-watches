<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use App\Traits\CartOptions;
use App\Category;
use App\Product;
use App\Website_brand;

class CartController extends Controller
{
    use CartOptions;

    protected $categories, $brands;

    public function __construct() {
        $this->categories = Category::Active()->OrderBy('order')->get();
        $this->brands = Website_brand::Active()->OrderBy('id')->get();
        View::share([
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    //show cart page function
    public function index() {
        return view("frontend.pages.cart");
    }
    
    //add to cart function - add products in cart using session whatever user login or not
    public function addToCart(Request $request, $product_id)
    {
        $validatedData = $request->validate([
            'qty' => 'required|min:1|numeric',
        ]);

        $product = Product::find($product_id);
        Auth::check() 
            ? $this->AddToCartDatabase(Auth::user(), $product, $request->input('qty'))
            : $this->AddToCartSession($product, $request->input('qty'));

        return Redirect::back();
    }

    //add product to cart by livewire product/card
    //upadte product quantity in cart by livewire cart/page
    //remove from cart in livewire cart/page 
}
