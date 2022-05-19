<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Setting;

class SettingController extends Controller
{
    //function index - show Setting page
    public function index()
    {
        $settings = Setting::all();
        return view('backend.setting.list')->with('settings',$settings);
    }

    //function edit - show edit setting page
    public function edit() {
        return view('backend.setting.update');
    }
}
