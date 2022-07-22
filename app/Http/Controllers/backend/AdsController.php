<?php

namespace App\Http\Controllers\backend;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
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
                $filename = 'ads/banner_'.$request->image->getClientOriginalName();
                $existInStorage = Storage::exists($filename);
                if(!$existInStorage) {
                    $filename = 'banner_'.$request->image->getClientOriginalName();
                    $path = $request->image->storeAs('ads',$filename);

                    Ad::create([
                        'product_id' => $request->input('product'),
                        'status' => $request->input('status'),
                        'image' => $path,
                    ]);

                    Session::flash('success','New Ad Banner added successfully');
                }
                else {
                    Session::flash('error','Banner image exists with same name');
                }
            }
            //logs stored when created by AdObserver in app\observers

            return Redirect::back();
        } catch (EXTENSION $e) {
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

        $this->validate($request, [
            'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,wmv,mpeg',
        ]);

        $ad = Ad::find($id);
        try {
            if($ad) {
                $ad->status = $request->input('status');
                if($request->has('image')) {
                    $filename = 'ads/banner_'.$request->image->getClientOriginalName();
                    $existInStorage = Storage::exists($filename);
                    if(!$existInStorage) {
                        Storage::Delete($ad->image);
                        $filename = 'banner_'.$request->image->getClientOriginalName();
                        $path = $request->image->storeAs('ads',$filename);
                        $ad->image = $path;
                    }
                    else {
                        Session::flash('error','Banner image exists with same name');
                    }
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
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }

    }

    //function destroy - delete ad
    public function destroy($id) {
        $ad = Ad::find($id);
        $existInStorage = Storage::exists($ad->image);
        $existInStorage ? Storage::Delete($ad->image) : '';
        $ad->delete();

        //logs stored when deleted by AdObserver in app\observers

        return Redirect::back();
    }

}
