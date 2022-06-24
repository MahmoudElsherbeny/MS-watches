<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Dashboard_log;

class LogsCtrl extends Controller
{
    //function index - show dashboard logs page and logs live search
    public function index(Request $request)
    {
        return view('backend.logs.list');
    }

    //function destroy - clear all logs
    public function destroy() {
        //delete all records
        Dashboard_log::truncate();
        return Redirect::route('DashLogs.index');
    }

}
