<?php

namespace App\Http\Livewire\Backend\Product;

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Update extends Component
{
    public $name, $category, $mini_description, $description, $price;
    public $body_color, $mina_color, $tags, $status, $editorId;
    public $product;

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/',
        'mini_description' => 'required',
        'description' => 'required',
        'price' => 'required|numeric|gt:0',
        'body_color' => 'required|alpha',
        'mina_color' => 'required|alpha',
    ];

    public function mount() {
        $this->name = $this->product->name;
        $this->category = $this->product->category_id;
        $this->mini_description = $this->product->mini_description;
        $this->description = $this->product->description;
        $this->price = $this->product->price/100;
        $this->body_color = $this->product->body_color;
        $this->mina_color = $this->product->mina_color;
        $this->tags = $this->product->tags;
        $this->status = $this->product->status;
        $this->editorId = Auth::guard('admin')->user()->id;
    }

    public function update() {
        
        $this->validate();
        if($this->product) {
            $this->product->name = $this->name;
            $this->product->category_id = $this->category;
            $this->product->mini_description = $this->mini_description;
            $this->product->description = $this->description;
            $this->product->price = $this->price*100;
            $this->product->body_color = $this->body_color;
            $this->product->mina_color = $this->mina_color;
            $this->product->tags = $this->tags;
            $this->product->status = $this->status;
            $this->product->admin_id = Auth::guard('admin')->user()->id;

            if($this->product->isDirty()) {
                $this->product->save();
                Session::flash('success','Product Updated Successfully');
            }
            else {
                Session::flash('error','No Changes To Update');
            }

            //logs stored when updated by productObserver in app\observers
        }
        else {
            Session::flash('error','Product Not Exist');
        }
        
    }

    public function render()
    {
        $categories = Category::Where('status','active')->OrderBY('name')->get();
        return view('livewire.backend.product.update')->with('categories', $categories);
    }
}
