<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Traits\ApiGeneralTrait;
use Illuminate\Http\Request;

use App\Product;

class ProductsController extends Controller
{
    use ApiGeneralTrait;
    
    public function index() {
        $products = Product::all();
        if($products)
            return $this->returnData('products', $products, 'all_products');
        else
            return $this->returnErrorMsg(001, 'No Products Found');
    }

    public function ProductById(Request $request) {
        $product = Product::find($request->id);
        if($product)
            return $this->returnData('product', $product, 'product with id: '.$request->id.'');
        else
            return $this->returnErrorMsg(001, 'No Product Found');
    }

}