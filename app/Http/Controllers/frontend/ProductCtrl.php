<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Product_image;
use App\Product_review;
use Redirect;
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
        $product = Product::Where('status', 'active')->findOrFail($id);
        $product_images = $product->product_images()->orderBy('order')->get();
        $product_reviews = $product->product_reviews()->OrderBy('created_at','DESC')->get();
        $related_products = Product::Where(['status' => 'active', 'tags' => $product->tags, 'category_id' => $product->category_id])
                                   ->Where('id', '!=', $product->id)
                                   ->Where(function($query) use($product) {
                                           $query->Where('name', 'like', '%'.$product->name.'%')
                                               ->orWhere('body_color', 'like', '%'.$product->body_color.'%')
                                               ->orWhere('mina_color', 'like', '%'.$product->mina_color.'%');
                                   })->inRandomOrder()->limit(15)->get();
 
        return view("frontend.product.product_detailes")->with([
                    'product' => $product,
                    'product_images' => $product_images,
                    'product_reviews' => $product_reviews,
                    'related_products' => $related_products
                ]);
    }

    //product review store and update with livewire

    //delete product review
    public function review_destroy($id,$review) {
        $user_review = Product_review::findOrFail($review);
        $user_review->delete();
        return Redirect::back();
    }


}
