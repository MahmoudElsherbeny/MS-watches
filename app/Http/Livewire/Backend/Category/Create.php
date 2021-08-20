<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Category;
use Session;
use Redirect;

class Create extends Component
{

    public $name;
    public $icon;
    public $order;
    public $status;

    protected $rules = [
        'name' => 'required|max:40|min:3|regex:/^[a-zA-Z0-9 ]+$/',
        'order' => 'required|numeric|max:15'
    ];

    public function mount() {
        $this->icon = 'fa fa-th-large';
        $this->status = 'active';
    }

    //function store - store category data into database
    public function store() {
        
        $this->validate();
        //check if the category already exist or not
        if(Category::Where('name',$this->name)->count() == 0) {

            Category::create([
                'name' => $this->name,
                'icon' => $this->icon,
                'order' => $this->order,
                'status' => $this->status,
            ]);
            //logs stored when created by category observer in app\observers

            Session::flash('success','category created successfully');
        }
        else {
            Session::flash('error','category already exist');
        }
        
        return Redirect::route('category.create');
    }

    public function render()
    {
        return view('livewire.backend.category.create')->extends('backend.layouts.app');
    }
}
