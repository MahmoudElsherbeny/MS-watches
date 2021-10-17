<?php

namespace App\Http\Livewire\Backend\States;

use Livewire\Component;

use App\State;
use Session;
use Redirect;
use Auth;

class Create extends Component
{

    public $state;
    public $delivery;

    protected $rules = [
        'state' => 'required|max:30|min:3',
        'delivery' => 'required|numeric|gt:0'
    ];

    

    //function store - store state data into database
    public function store() {
        
        $this->validate();
        //check if the state already exist or not
        if(State::Where('state',$this->state)->count() == 0) {

            State::create([
                'state' => $this->state,
                'delivery' => $this->delivery,
            ]);
            //logs stored when created by state observer in app\observers

            Session::flash('success','state created successfully');
        }
        else {
            Session::flash('error','state '.$this->state.' already exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.states.create');
    }
}
