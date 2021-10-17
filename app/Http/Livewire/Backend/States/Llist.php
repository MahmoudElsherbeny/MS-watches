<?php

namespace App\Http\Livewire\Backend\States;

use Livewire\Component;

use App\State;
use Session;
use Redirect;
use Auth;

class Llist extends Component
{
    public $state;
    public $delivery;

    protected $rules = [
        'state' => 'required|max:30|min:3',
        'delivery' => 'required|numeric|gt:0'
    ];

    public function mount() {
        $this->state = $this->category->name;
        $this->delivery = $this->category->icon;
    }

    public function update() {
        
        $this->validate();
        if($this->state != null) {
            $this->state->state = $this->state;
            $this->state->icon = $this->icon;
            $this->state->save();

            //logs stored when updated by state observer in app\observers

            Session::flash('success','state Updated Successfully');
        }
        else {
            Session::flash('error','state Not Exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.states.llist')->with('states', State::orderBY('delivery')->get());
    }
}
