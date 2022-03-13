<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Product;
use App\Product_image;
use App\Category;
use Session;
use Redirect;
use Auth;
use File;

class ProductCtrl extends Controller
{
    //function index - show products page and products live search
    public function index(Request $request)
    {
        /*
        if($request->ajax())
        {
            $products = Product::where('name','LIKE','%'.$request->prod_search."%")->orderBY('created_at','DESC')->paginate(30);
            $prodCount = $products->total();
            $returnProducts = view('backend.product.search')->with('products',$products)->render();
            return Response()->json(['data'=>$returnProducts, 'count'=>$prodCount]);
        }
        else {
            $products = Product::orderBY('created_at','DESC')->paginate(30);
            return view('backend.product.list')->with('products',$products);
        }
        */

        return view('backend.product.list');
    }

    //function creat - show create new product page
    public function create() {
        $categories = Category::orderBY('name')->get();
        return view('backend.product.create')->with('categories',$categories);
    }

    //function store - store product data into database



    //delete function - delete product data and it's images
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product_images = Product_image::Where('product',$product->id)->get();
        foreach($product_images as $img) {
            Storage::Delete('public/products/'.$img->image);
        }
        $product->delete();
        $product_images->each->delete();
        return Redirect::route('product.index');
    }

    // product function - show product page with all product's data
    public function product($id) {
        $product = Product::findOrFail($id);
        $product_images = Product_image::Where('product',$id)->orderBy('order')->get();
        return view('backend.product.product')->with(['product' => $product, 'product_images' => $product_images]);
    }

    // image update function - update product image
    public function image_update(Request $request,$id,$image) {
        $validatedData = $request->validate([
            'order' => 'required|numeric|max:10'
        ]);

        try {

            $image = Product_image::find($image);
            if($image != null) {
                $image->order = $request->input('order');
                $image->save();
            }
            return Redirect::back();

        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
    }

    //delete function - delete product data and it's images
    public function image_destroy($id,$image) {
        $product_image = Product_image::find($image);

        Storage::Delete('public/products/'.$product_image->image);
        $product_image->delete();
        return Redirect::back();
    }

    public function sale(Request $request, $id) {
        $validatedData = $request->validate([
            'new_price' => 'required|numeric|gt:0',
        ]);

        try {
            $product = Product::find($id);
            if($product) {
                $product->sale = $request->input('new_price');
                $product->save();
            }

            //logs stored when created by product observer in app\observers
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }

        return Redirect::back();
    }

}
