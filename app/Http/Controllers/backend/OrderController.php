<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Order;

class OrderController extends Controller
{
    //function index - show orders page and orders live search
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $products = Product::where('name','LIKE','%'.$request->prod_search."%")->orderBY('created_at','DESC')->paginate(30);
            $prodCount = $products->total();
            $returnProducts = view('backend.product.search')->with('products',$products)->render();
            return Response()->json(['data'=>$returnProducts, 'count'=>$prodCount]);
        }
        else {
            $orders = Order::orderBY('created_at','DESC')->paginate(30);
            return view('backend.orders.list')->with('orders',$orders);
        }
    }
}
