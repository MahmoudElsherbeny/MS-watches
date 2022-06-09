<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Product;
use App\Product_image;
use App\Product_review;

class ProductCtrl extends Controller
{
    //function index - show products page and products live search
    public function index()
    {
        return view('backend.product.list');        
    }

    //function creat - show create new product page
    public function create() {
        return view('backend.product.create');
    }

    //function edit - show edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.update')->with('product', $product);
    }

    //store, update, delete and update price for product data with livewire components in livewire/backend/product


    /******************    product detailes    ******************/
    // product function - show product page with all product's data
    public function product($id) {
        $product = Product::findOrFail($id);
        $product_images = $product->product_images()->orderBy('order')->get();
        return view('backend.product.product')->with(['product' => $product, 'product_images' => $product_images]);
    }

    // image add function - add new product image in image table
    public function image_add(Request $request,$prod_id) {
        $validatedData = $request->validate([
            'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,wmv,mpeg',
        ]);

        try {
            $image = $request->file('image');
            if($image) {
                $filename = 'products/watche_'.$image->getClientOriginalName();
                $imageExist = Product_image::Where(['product_id' => $prod_id, 'image' => $filename])->first();
                if(!$imageExist) {
                    $filename = 'watche_'.$image->getClientOriginalName();
                    $path = $image->storeAs('products',$filename);
                    
                    Product_image::create([
                        'product_id' => $prod_id,
                        'image' => $path,
                        'order' => 1,
                    ]);
                }
            }
            return Redirect::back();

        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }
    }

    // image update function - update product image in image table
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

    //delete function - delete product image in images in table
    public function image_destroy($id,$image) {
        $product_image = Product_image::find($image);

        Storage::Delete('public/products/'.$product_image->image);
        $product_image->delete();
        return Redirect::back();
    }

    //function reviews - show products reviews page
    public function reviews()
    {
        return view('backend.product.reviews');
    }

}
