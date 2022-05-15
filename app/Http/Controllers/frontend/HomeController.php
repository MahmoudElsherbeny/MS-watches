<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Product_avg_rate;
use App\Slide;
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

    //show shop page function
    public function shopPage() {
        return view("frontend.pages.shop");
    }

    //show about-us page function
    public function aboutus() {
        return view("frontend.pages.about");
    }

    //show contact us page function
    public function contact() {
        return view("frontend.pages.contact");
    }

    //show success alert page after registeration function
    public function register_success() {
        return view("frontend.pages.register_success");
    }

}
