<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Setting;
use App\Website_brand;
use App\Website_review;
use Exception;

class SettingController extends Controller
{
    //function index - show Website Setting page
    public function index()
    {
        $settings = Setting::all();
        return view('backend.setting.list')->with('settings',$settings);
    }

    //function edit - show edit Website setting page
    public function edit() {
        return view('backend.setting.update');
    }

    //function website_reviews - show website review page which chosen by admin
    public function website_reviews()
    {
        $reviews = Website_review::all();
        return view('backend.setting.website_reviews.list')->with('reviews',$reviews);
    }

    //function update - update website review status
    public function review_update(Request $request, $id) {
        try { 
            $review = Website_review::findOrFail($id);
            $review->update(['status' => $request->input('status')]);

            Session::flash('success','Review Status Updated Successfully');
            //logs in WebsiteReviewObserver in App\observers

            return Redirect::back();
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e->getMessage());
        }
    }

    //function destroy - remove review as website review
    public function review_destroy($id) {
        $review = Website_review::findOrFail($id);
        $review->delete();
        //logs in WebsiteReviewObserver in App\observers

        return Redirect::route('setting.reviews');
    }

    //function website_brands - show website brands page
    public function website_brands()
    {
        return view('backend.setting.website_brands.list');
    }

    //function brand_create - show create new website brand page
    public function brand_create()
    {
        return view('backend.setting.website_brands.create');
    }

    //function brand_edit - show edit website brand page
    public function brand_edit($id)
    {
        $brand = Website_brand::findOrFail($id);
        return view('backend.setting.website_brands.update')->with('brand',$brand);
    }

}
