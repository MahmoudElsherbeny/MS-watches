<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Admin;
use App\Order_item;
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

        return view('backend.product_store.product_store_history')->with([
                'product' => $product,
                'from' => $from,
                'to' => $to,
                'product_stores' => $product_stores,
                'avg_unit_price' => $avg_unit_price,
            ]);        
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

        $product = Product::findOrFail($request->input('product'));
        try {
            DB::transaction(function () use($product, $request) {
                $new_quantity = Products_store::create([
                    'product_id' => $request->input('product'),
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'quantity' => $request->input('quantity'),
                    'unit_price' => $request->input('total')*100 / $request->input('quantity'),
                    'total' => $request->input('total')*100,
                ]);

                $product->increment('all_quantity', $new_quantity->quantity);
                $product->increment('quantity', $new_quantity->quantity);

                Session::flash('success','New product quantity added successfully');
            });

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function edit_quantity - edit products quantity and it's data
    public function edit_quantity($prod_id, $prod_quantity_id)
    {
        $product_store = Products_store::findOrFail($prod_quantity_id);
        if(Order_item::countOrdersAfterQtyAdd($product_store->product_id, $product_store->updated_at) == 0) {
            return view('backend.product_store.edit_quantity')->with('product_store',$product_store);
        }
        return Redirect::back();
    }

    public function update(Request $request, $prod_id, $prod_quantity_id) { 

        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
        ]);

        $product_store = Products_store::findOrFail($prod_quantity_id);
        $product = Product::find($product_store->product_id);
        try {
            $diff_quantity = $request->input('quantity') - $product_store->quantity;
            if(Order_item::countOrdersAfterQtyAdd($product_store->product_id, $product_store->updated_at) > 0) {
                Session::flash('error','you cant edit this quantity because there are orders set');
            }
            elseif(($product->quantity + $diff_quantity) <= 0) {
                Session::flash('error','Product quantity will be under 0 with this quantity update');
            }
            else {
                DB::transaction(function () use($product_store, $product, $diff_quantity, $request) {
                    $product_store->admin_id = Auth::guard('admin')->user()->id;
                    $product_store->quantity = $request->input('quantity');
                    $product_store->unit_price = $request->input('total')*100 / $request->input('quantity');
                    $product_store->total = $request->input('total')*100;
                    $product_store->save();

                    $product->increment('all_quantity', $diff_quantity);
                    $product->increment('quantity', $diff_quantity);

                    Session::flash('success','Product quantity updated successfully');
                });
            }

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function destroy - delete product quantity
    public function destroy($id) {
        $product_store = Products_store::findOrFail($id);
        $product = Product::findOrFail($product_store->product_id);
        if(Order_item::countOrdersAfterQtyAdd($product_store->product_id, $product_store->updated_at) == 0) {
            DB::transaction(function () use($product_store, $product) {
                $product_store->delete();
                $product->decrement('all_quantity', $product_store->quantity);
                $product->decrement('quantity', $product_store->quantity);
            });
        }

        return Redirect::back();
    }
}
