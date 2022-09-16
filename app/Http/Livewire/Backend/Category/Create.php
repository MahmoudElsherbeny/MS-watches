<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\CategoryNotification;
use App\Admin;
use App\Category;
use Exception;

class Create extends Component
{
    public $name, $icon, $order, $status;

    protected $rules = [
        'name' => 'required|max:40|min:3|regex:/^[a-zA-Z0-9 ]+$/|unique:categories',
        'icon' => 'required',
        'order' => 'required|numeric|max:15|min:1',
        'status' => 'required',
    ];

    public function mount() {
        $this->icon = 'fa fa-th-large';
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.backend.category.create');
    }

    //function store - store category data into database
    public function store() {
        $values = $this->validate();

        try {
            DB::beginTransaction();

                Category::create($values);

                $this->resetExcept(['status', 'icon']);
                Notification::send(Admin::Active()->get(), new CategoryNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');

                Session::flash('success','category created successfully');
                //logs stored when created by CategoryObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }

}