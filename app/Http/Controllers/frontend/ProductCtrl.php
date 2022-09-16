<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use App\Category;
use App\Product;
use App\Product_review;
use App\Website_brand;

class ProductCtrl extends Controller
{
    protected $categories, $brands;

    public function __construct() {
        $this->categories = Category::Active()->OrderBy('order')->get();
        $this->brands = Website_brand::Active()->OrderBy('id')->get();
        View::share([
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    //show product detailes page function
    public function product_detailes($id) {
        $product = Product::Active()->findOrFail($id);
        $product_images = $product->product_images()->orderBy('order')->get();
        $product_reviews = $product->product_reviews()->OrderBy('created_at','DESC')->get();
        $related_products = Product::Active()->Where(['tags' => $product->tags, 'category_id' => $product->category_id])
                                   ->Where('id', '!=', $product->id)
                                   ->Where(function($query) use($product) {
                                           $query->Where('name', 'like', '%'.$product->name.'%');
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