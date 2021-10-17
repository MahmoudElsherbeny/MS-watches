<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\State;

class StateController extends Controller
{
    
    //function index - show states page
    public function index()
    {
        $states = State::orderBY('delivery')->get();
        return view('backend.states.list')->with('states',$states);
    }

    //function creat - show create new state page
    public function create() {
        return view('backend.states.create');
    }

}
