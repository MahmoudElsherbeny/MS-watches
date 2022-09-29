<?php

namespace App\Http\Livewire\Backend\States;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\StateNotification;
use App\Admin;
use App\State;
use Exception;

class Create extends Component
{
    public $state, $delivery;

    protected $rules = [
        'state' => 'required|max:30|min:3|unique:states',
        'delivery' => 'required|numeric|gt:0'
    ];

    public function render()
    {
        return view('livewire.backend.states.create');
    }

    //function store - store state data into database
    public function store() {
        $values = $this->validate();

        try {
            State::create($values);

            $this->reset();
            Session::flash('success','state created successfully');

            Notification::send(Admin::Active()->role('admin')->get(), new StateNotification(Auth::guard('admin')->user()->id, 'added'));
            $this->emit('notifications');
            //logs stored when created by state observer in app\observers
        } catch (Exception $e) {
            Session::flash('error','Error: '.$e->getMessage());
        }   
    }
}