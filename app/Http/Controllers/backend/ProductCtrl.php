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
        
        if($request->ajax())
        {
            $products = Product::where('name','LIKE','%'.$request->prod_search."%")->orderBY('created_at','DESC')->paginate(30);
            $prodCount = $products->total();
            $returnProducts = view('backend.product.search')->with('products',$products)->render();
            return Response()->json(['data'=>$returnProducts, 'count'=>$prodCount]);
        }
        else {
            $prodAllCount = Product::count();
            $products = Product::orderBY('created_at','DESC')->paginate($prodAllCount);
            return view('backend.product.list')->with('products',$products);
        }
        
    }

    //function creat - show create new product page
    public function create() {
        return view('backend.product.create');
    }

    //function store - store product data into database



    //delete function - delete product data and it's images
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product_images = Product::findOrFail($id)->product_images;
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
        $product_images = $product->product_images()->orderBy('order')->get();
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

    //sale function - make discount on product price
    public function sale(Request $request, $id) {
        $validatedData = $request->validate([
            'new_price' => 'required|numeric|gt:0',
        ]);

        try {
            $product = Product::find($id);
            if($product) {
                $product->old_price = $product->price;
                $product->price = $request->input('new_price')*100;
                $product->save();
            }

            //logs stored when created by product observer in app\observers
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }

        return Redirect::back();
    }

}
