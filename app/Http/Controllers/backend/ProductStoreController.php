<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Notifications\ProductStoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;

use App\Admin;
use App\Order_item;
use App\Product;
use App\Products_store;


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
        $avg_unit_price = count($product_stores) > 0 ? $total_unit_price/count($product_stores) : 0;

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
        return view('backend.product_store.add_quantity');        
    }

    //function edit_quantity - edit products quantity and it's data
    public function edit_quantity($prod_id, $prod_quantity_id)
    {
        $product_store = Products_store::findOrFail($prod_quantity_id);
        return Order_item::countOrdersAfterQtyAdd($product_store->product_id, $product_store->updated_at) == 0
            ? view('backend.product_store.edit_quantity')->with('product_store',$product_store)
            : Redirect::back();
    }
    //add and update product qty with livewire component

    //function destroy - delete product quantity
    public function destroy($id) {
        $product_store = Products_store::findOrFail($id);
        if(Order_item::countOrdersAfterQtyAdd($product_store->product_id, $product_store->updated_at) == 0) {
            DB::transaction(function () use($product_store) {
                $product_store->delete();
                $product_store->product->decrement('all_quantity', $product_store->quantity);
                $product_store->product->decrement('quantity', $product_store->quantity);

                Notification::send(Admin::Active()->role('admin')->get(), new ProductStoreNotification(Auth::guard('admin')->user()->id, 'deleted'));
            });
        }

        return Redirect::back();
    }
}
