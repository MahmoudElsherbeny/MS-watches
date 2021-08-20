<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashController extends Controller
{

    //show dashboard page function
    public function dashboard() {
        return view("backend.dashboard");
    }
}
