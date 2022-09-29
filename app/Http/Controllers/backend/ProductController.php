<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\ProductNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Product;
use App\Product_image;
use Exception;

class ProductController extends Controller
{
    use ImageFunctions;

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

    //delete function - delete product data and it's images, reviews
    public function destroy($id) {
        $product = Product::findOrFail($id);
        try {
            DB::beginTransaction();
                foreach($product->product_images as $img) {
                    $this->delete_if_exist($img->image);
                }
                $product->product_images->each->delete();
                foreach($product->banners as $banner) {
                    $this->delete_if_exist($banner->image);
                }
                $product->banners->each->delete();
                $product->product_reviews->each->delete();
                $product->products_stores->each->delete();
                $product->delete();

                Notification::send(Admin::Active()->get(), new ProductNotification(Auth::guard('admin')->user()->id, 'deleted with related items'));
                //logs stored when deleted by ProductObserver in app\observers
            DB::commit();
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }

    //store, update, delete and update price for product data with livewire components in livewire/backend/product


    /******************    product detailes    ******************/
    // product function - show product page with all product's data
    public function product($id) {
        $product = Product::findOrFail($id);
        return view('backend.product.product')->with(['product' => $product]);
    }

    // image add function - add new product image in image table
    public function image_add(Request $request,$prod_id) {
        $validatedData = $request->validate([
            'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,wmv,mpeg',
        ]);

        try {
            $image = $request->file('image');
            if($image) {
                $prod_imgs = Product_image::Where('product_id', $prod_id)->get();
                if(count($prod_imgs) < 4) {
                    Product_image::create([
                        'product_id' => $prod_id,
                        'image' => $this->store_image_path($image, 'products'),
                        'order' => 1,
                    ]);
                }
                else {
                    Session::flash('error','products have maximum number of images');
                }
            }

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }
    }

    // image update function - update product image in image table
    public function image_update(Request $request,$id,$image) {
        $validatedData = $request->validate([
            'order' => 'required|numeric|max:10'
        ]);

        try {
            $image = Product_image::findOrFail($image);
            $image->update($validatedData);

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e->getMessage());
        }
    }

    //delete function - delete product image in images in table
    public function image_destroy($id,$image) {
        $product_image = Product_image::find($image);
        $this->delete_if_exist($product_image->image);
        $product_image->delete();
        
        return Redirect::back();
    }

    //function reviews - show products reviews page
    public function reviews()
    {
        return view('backend.product.reviews');
    }

}
