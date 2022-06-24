<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Category;
use App\Product;

class Update extends Component
{
    public $name;
    public $icon;
    public $order;
    public $status;
    public $category;

    protected $rules = [
        'name' => 'required|max:40|min:3|regex:/^[a-zA-Z0-9 ]+$/',
        'order' => 'required|numeric|max:15'
    ];

    public function mount() {
        $this->name = $this->category->name;
        $this->icon = $this->category->icon;
        $this->order = $this->category->order;
        $this->status = $this->category->status;
    }

    public function update() {
        
        $this->validate();
        if($this->category != null) {
            $this->category->name = $this->name;
            $this->category->icon = $this->icon;
            $this->category->order = $this->order;
            $this->category->status = $this->status;

            if($this->category->isDirty()) {
                $this->category->save();

                //update products status dependes on category status
                if($this->status == 'not active') {
                    Product::Where('category', $this->category->id)->update(['status' => 'not active']);
                }
                elseif($this->status == 'active') {
                    Product::Where('category', $this->category->id)->update(['status' => 'active']);
                }

                Session::flash('success','Category Updated Successfully');
            }
            else {
                Session::flash('error','No Changes To Update');
            }

            //logs stored when updated by category observer in app\observers
        }
        else {
            Session::flash('error','Category Not Exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.category.update');
    }
}
