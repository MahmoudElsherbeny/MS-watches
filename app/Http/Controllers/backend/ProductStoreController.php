<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Admin;
use App\Product;
use App\Products_store;
use Exception;
use Illuminate\Support\Carbon;

class ProductStoreController extends Controller
{
    //function index - show products store page and products live search
    public function index()
    {
        return view('backend.product_store.list');        
    }

    //function add_quantity - add products new quantity and it's data
    public function add_quantity()
    {
        $products = Product::select('id','name','all_quantity','quantity')->OrderBy('name')->get();
        return view('backend.product_store.add_quantity')->with('products',$products);        
    }

    public function store(Request $request) { 

        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
        ]);

        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $product = Product::find($request->input('product'));
        try {
            if($product) {
                DB::transaction(function () use($admin, $product, $request) {
                    $new_quantity = Products_store::create([
                        'product_id' => $request->input('product'),
                        'admin_id' => $admin->id,
                        'quantity' => $request->input('quantity'),
                        'unit_price' => $request->input('total')*100 / $request->input('quantity'),
                        'total' => $request->input('total')*100,
                    ]);

                    $product->increment('all_quantity', $new_quantity->quantity);
                    $product->increment('quantity', $new_quantity->quantity);

                    Session::flash('success','New product quantity added successfully');
                });
            }

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function index - show products store page and products live search
    public function product_history(Request $request, $prod_id,$prod_name)
    {
        $total_unit_price = 0;
        $product = Product::findOrFail($prod_id);
        if($request->input('from') || $request->input('to')) {
            $from = $request->input('from');
            $to = $request->input('to');
        }
        else {
            $from = Carbon::now()->subDays(30)->format('Y-m-d');
            $to = date('Y-m-d');
        }
        $product_stores = $product->products_stores()
                                  ->WhereDate('created_at','>=',$from)
                                  ->WhereDate('created_at','<=',$to)
                                  ->paginate(30);
        foreach($product_stores as $prod) {
            $total_unit_price += $prod->unit_price;
        } 
        count($product_stores) > 0 ? $avg_unit_price = $total_unit_price/count($product_stores) : $avg_unit_price = 0;

        return view('backend.product_store.product_store_history')
             ->with([
                     'product' => $product,
                     'from' => $from,
                     'to' => $to,
                     'product_stores' => $product_stores,
                     'avg_unit_price' => $avg_unit_price,
                    ]);        
    }

}
