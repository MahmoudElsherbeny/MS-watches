<?php

namespace App\Http\Controllers\backend;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class DashController extends Controller
{

    //show dashboard page function
    public function dashboard() {
        $done_orders = Order::Where('status', 'completed');
        $success_orders = $done_orders->get();
        $total_sum = $done_orders->sum('total');
        $users = User::all();
        return view("backend.dashboard")->with([
            'success_orders' => $success_orders,
            'total_sum' => $total_sum,
            'users' => $users,
        ]);
    }

}
