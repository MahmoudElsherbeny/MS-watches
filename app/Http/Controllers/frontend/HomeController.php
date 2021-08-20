<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Product_avg_rate;
use App\Slide;
use DB;
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
        $latest_products = Product::Where('status','active')
                                  ->Where('sale','<=',0)
                                  ->OrderBy('id','DESC')->limit(12)->get();

        $onsale_products = Product::Where('status','active')
                                  ->Where('sale','>',0)
                                  ->OrderBy('updated_at','DESC')->limit(12)->get();

        $bestsale_products = Product::Where('status','active')
                                    ->Where('sale','>',0)
                                    ->OrderBy('sale','DESC')->limit(12)->get();

        $toprate_products = DB::table('products')
                              ->select('products.*', 'product_avg_rates.product', 'product_avg_rates.avg_rate')
                              ->join('product_avg_rates', 'product_avg_rates.product', '=', 'products.id')
                              ->Where('products.status', 'active')
                              ->orderBy('avg_rate','DESC')->limit(12)->get();                           
        
        return view("frontend.index")->with([
                                    'slides' => $slides,
                                    'latest' => $latest_products,
                                    'onsale' => $onsale_products,
                                    'bestsale' => $bestsale_products,
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

}
