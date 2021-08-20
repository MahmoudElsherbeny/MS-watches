<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Dashboard_log;
use Session;
use Redirect;

class LogsCtrl extends Controller
{
    //function index - show dashboard logs page and logs live search
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $logs = Dashboard_log::whereDate('date','=',$request->logs_search)->orderBY('date','DESC')->get();
            $logsCount = count($logs);
            $returnLogs = view('backend.logs.search')->with('logs',$logs)->render();
            return Response()->json(['data'=>$returnLogs, 'count'=>$logsCount]);
        }
        else {
            $logs = Dashboard_log::orderBY('date','DESC')->get();
            return view('backend.logs.list')->with('logs',$logs);
        }
    }

    //function destroy - clear all logs
    public function destroy() {
        //delete all records
        Dashboard_log::truncate();
        return Redirect::route('DashLogs.index');
    }

}
