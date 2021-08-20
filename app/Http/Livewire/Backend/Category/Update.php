<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Category;
use App\Product;
use Session;
use Redirect;

class Update extends Component
{
    public $name;
    public $icon;
    public $order;
    public $status;
    public $categoryId;
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
            $this->category->save();

            //update products status dependes on category status
            if($this->status == 'not active') {
                Product::Where('category', $this->categoryId)->update(['status' => 'not active']);
            }
            elseif($this->status == 'active') {
                Product::Where('category', $this->categoryId)->update(['status' => 'active']);
            }

            //logs stored when updated by category observer in app\observers

            Session::flash('success','Category Updated Successfully');
        }
        else {
            Session::flash('error','Category Not Exist');
        }
        return Redirect::route('category.edit', ['id' => $this->category]);
        
    }

    public function render()
    {
        return view('livewire.backend.category.update');
    }
}
