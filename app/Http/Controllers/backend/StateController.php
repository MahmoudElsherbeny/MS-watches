<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\State;
use Redirect;

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

    //function update - update state data
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'state' => 'required|max:30|min:3',
            'delivery' => 'required|numeric|gt:0'
        ]);

        try {
            $state = State::find($id);
            if($state) {
                $state->state = $request->input('state');
                $state->delivery = $request->input('delivery');
                $state->save();
            }

            //logs stored when updated by state observer in app\observers
        } catch (EXTENSION $e) {
            Session::flash('error','Error:'.$e);
        }

        return Redirect::back();
    }

    //function destroy - delete state
    public function destroy($id) {

        //delete state
        $state = State::find($id);
        $state->delete();

        //logs stored when deleted by state observer in app\observers

        return Redirect::back();
    }

}
