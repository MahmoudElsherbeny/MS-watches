<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Product_image;
use App\Product_review;
use Auth;
use Redirect;
use Session;
use View;

class ProductCtrl extends Controller
{
    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //show product detailes page function
    public function product_detailes($id) {
        $product = Product::Where(['id' => $id, 'status' => 'active'])->first();
        $product_images = Product_image::Where('product',$id)->orderBy('order')->get();
        $product_reviews = Product_review::Where('product',$id)->OrderBy('created_at','DESC')->get();
        if($product) {
            return view("frontend.pages.product_detailes")->with([
                'product' => $product,
                'product_images' => $product_images,
                'product_reviews' => $product_reviews
                ]);
        }
        else {
            return abort(404);
        }
    }

    //product review store with livewire

    //delete product review
    public function review_destroy($id,$review) {
        $user_review = Product_review::findOrFail($review);
        $user_review->delete();
        return Redirect::back();
    }


    //add to cart function -
    public function addToCart($id)
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }

        $cart = Session::get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        //"photo" => $product->image
                    ]
            ];
            Session::put('cart', $cart);

            return Redirect::back();
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->put('cart', $cart);

            return Redirect::back();
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            //"photo" => $product->photo
        ];
        Session::put('cart', $cart);

        return Redirect::back();
    }

}
