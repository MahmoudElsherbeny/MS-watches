<?php

namespace App\Http\Controllers\backend;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\ImageFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    use ImageFunctions;

    //function index - show ads list page and ads live search
    public function index()
    {
        $ads = Ad::orderBy('created_at','DESC')->get();
        return view('backend.ads.list')->with('ads', $ads);
    }

    //function creat - show create new ad page
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('backend.ads.create')->with('products', $products);
    }

    //function store - store new ad into database
    public function store(Request $request) { 

        $this->validate($request, [
            'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,wmv,mpeg',
        ]);

        $product = Product::find($request->input('product'));
        try {
            if($product) {
                $adExist = Ad::select('product_id')->Where('product_id', $request->input('product'))->first();
                if(!$adExist) {
                    Ad::create([
                        'product_id' => $request->input('product'),
                        'status' => $request->input('status'),
                        'image' => $this->store_image_path($request->image, 'ads'),
                    ]);

                    Session::flash('success','New Ad Banner added successfully');
                }
                else {
                    Session::flash('error','Ad Banner already exist');
                }
            }
            //logs stored when created by AdObserver in app\observers

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function edit - show edit ad page
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        return view('backend.ads.edit')->with('ad', $ad);
    }

    //function store - store new ad into database
    public function update(Request $request, $id) { 

        $validatedData = $request->validate([
            'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,wmv,mpeg',
        ]);

        $ad = Ad::find($id);
        try {
            if($ad) {
                $ad->status = $request->input('status');
                if($request->has('image')) {
                    $this->delete_if_exist($ad->image);
                    $ad->image = $this->store_image_path($request->image, 'ads');
                }

                if($ad->isDirty()) {
                    $ad->save();
                    Session::flash('success','Ad Updated Successfully');
                }
                else {
                    Session::flash('error','No Changes To Update');
                }
            }
            //logs stored when updated by AdObserver in app\observers

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function destroy - delete ad
    public function destroy($id) {
        $ad = Ad::find($id);
        $this->delete_if_exist($ad->image);
        $ad->delete();

        //logs stored when deleted by AdObserver in app\observers
        return Redirect::back();
    }

}
