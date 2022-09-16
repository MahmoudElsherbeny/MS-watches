<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Category;
use App\Product;
use App\Slide;
use App\Banner;
use App\Website_brand;
use App\Website_review;

class HomeController extends Controller
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

    //show home page function
    public function index() {
        $slides = Slide::Active()->OrderBy('order')->get();
        $banners = Banner::Active()->OrderBy('created_at','DESC');

        $toprate_products = Product::Where('status', 'active')
                                   ->Where('rate', '>',0)
                                   ->orderBy('rate','DESC')->limit(15)->get();

        return view("frontend.index")->with([
                                    'slides' => $slides,
                                    'banners' => $banners,
                                    'toprate' => $toprate_products
                                    ]);
    }

    //website search function enable user to search for products and display results

    //show category products page function
    public function category($cat_id) {
        $category = Category::Active()->findOrFail($cat_id);
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
        $brands = Website_brand::Active()->OrderBy('id')->get();
        return view("frontend.pages.about")->with(['reviews' => $reviews, 'brands' => $brands ]);
    }

    //show success alert page after registeration function
    public function register_success() {
        return view("frontend.pages.register_success");
    }

}
