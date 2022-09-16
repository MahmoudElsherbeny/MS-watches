<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Subnotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    //mark notification as read on click and go tp link
    public function mark_read(Request $request) {

        //$notify = Auth::guard('admin')->user()->unreadSubnotifications->where('id', $request->id);
        //$notify->markAsRead();

        $notify = Subnotification::Where('id', $request->id)->first();
        $notify->markAsRead();

        $sub_notify = Auth::guard('admin')->user()->Subnotifications->where('id', $request->id)->first();
        $link = $sub_notify->notification->data['link'];

        return Redirect::to($link);
    }
}
