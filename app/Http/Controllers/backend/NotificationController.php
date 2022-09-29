<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Subnotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    //mark notification as read on click and go tp link
    public function mark_read(Request $request) {
        $notify = Subnotification::Where('id', $request->id)->first();
        $notify->markAsRead();

        $sub_notify = Auth::guard('admin')->user()->Subnotifications->where('id', $request->id)->first();
        $link = $sub_notify->notification->data['link'];

        return Redirect::to($link);
    }

    //mark all notification as read
    public function mark_all_read() {
        count(Auth::guard('admin')->user()->unreadSubnotifications) > 0
            ? Auth::guard('admin')->user()->unreadSubnotifications()->update(['read_at' => Carbon::now()])
            : '';

        return Redirect::back();
    }
}
