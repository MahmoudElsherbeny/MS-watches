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
            return view("frontend.product.product_detailes")->with([
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


}
