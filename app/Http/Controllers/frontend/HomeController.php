<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Slide;
use App\Website_brand;
use App\Website_review;
use View;

class HomeController extends Controller
{

    protected $categories;

    public function __construct() {
        $this->categories = Category::Where('status','active')->OrderBy('order')->get();
        View::share('categories', $this->categories);
    }

    //show home page function
    public function index() {
        $slides = Slide::Where('status','active')->OrderBy('order')->get();

        $toprate_products = Product::Where('status', 'active')
                                   ->Where('rate', '>',0)
                                   ->orderBy('rate','DESC')->limit(15)->get();

        return view("frontend.index")->with([
                                    'slides' => $slides,
                                    'toprate' => $toprate_products
                                    ]);
    }

    //website search function enable user to search for products and display results

    //show category products page function
    public function category($cat_id) {
        $category = Category::Where('status','active')->findOrFail($cat_id);
        $products = Product::Where('status','active')
                           ->Where('category_id',$cat_id)
                           ->orderBy('id','DESC')->get();

        return view("frontend.pages.category")->with([
                                            'category' => $category,
                                            'products' => $products
                                        ]);
    }
    
    //show shop page and products search results function
    public function shopPage(Request $request) {
        //if there search value pass to shop page
        $search_for = $request->input('site_search');
        return view("frontend.pages.shop")->with('search_for',$search_for);
    }

    //show about-us page function
    public function aboutus() {
        $reviews = Website_review::Where('status','active')->get();
        $brands = Website_brand::Where('status','active')->OrderBy('id')->get();
        return view("frontend.pages.about")->with(['reviews' => $reviews, 'brands' => $brands ]);
    }

    //show success alert page after registeration function
    public function register_success() {
        return view("frontend.pages.register_success");
    }

}
