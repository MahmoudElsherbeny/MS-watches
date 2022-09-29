<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\StateNotification;
use App\Admin;
use App\State;
use Exception;

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
            'delivery' => 'required|numeric|gt:0'
        ]);

        try {
            $state = State::find($id);
            $state ? $state->update($validatedData) : '';

            Notification::send(Admin::Active()->role('admin')->get(), new StateNotification(Auth::guard('admin')->user()->id, 'updated'));
            //logs stored when updated by state observer in app\observers
        } catch (Exception $e) {
            Session::flash('error','Error:'.$e);
        }

        return Redirect::back();
    }

    //function destroy - delete state
    public function destroy($id) {
        $state = State::findOrFail($id);
        $state->delete();

        Notification::send(Admin::Active()->role('admin')->get(), new StateNotification(Auth::guard('admin')->user()->id, 'deleted'));
        //logs stored when deleted by state observer in app\observerss
        return Redirect::back();
    }

}
