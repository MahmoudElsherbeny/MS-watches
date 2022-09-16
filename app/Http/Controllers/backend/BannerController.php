<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Traits\ImageFunctions;
use App\Banner;
use Exception;

class BannerController extends Controller
{
    use ImageFunctions;

    //function index - show Banners list page and Banners live search
    public function index()
    {
        $banners = Banner::orderBy('created_at','DESC')->get();
        return view('backend.Banners.list')->with('banners', $banners);
    }

    //function creat - show create new Banner page
    public function create()
    {
        return view('backend.Banners.create');
    }

    //function edit - show edit Banner page
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.Banners.edit')->with('banner', $banner);
    }

    //function destroy - delete Banner
    public function destroy($id) {
        $banner = Banner::findOrfail($id);
        try {
            DB::beginTransaction();

                $this->delete_if_exist($banner->image);
                $banner->delete();

            DB::commit();
            //logs stored when deleted by BannerObserver in app\observers
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }
}
