<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use App\Notifications\ProductNotification;
use App\Admin;
use App\Category;
use Exception;

class Update extends Component
{
    public $name, $category, $mini_description, $description, $price, $tags, $status;
    public $attr_data = [];
    public $product;

    public function rules() {
        return [
            'name' => [
                'required', 'max:100', 'min:3', 'regex:/^[a-zA-Z0-9-\s]+$/',
                Rule::unique('products')->ignore($this->product->name, 'name'),
            ],
            'mini_description' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
        ];
    }

    public function mount() {
        $this->name = $this->product->name;
        $this->category = $this->product->category_id;
        $this->mini_description = $this->product->mini_description;
        $this->description = $this->product->description;
        $this->price = $this->product->price/100;
        $this->tags = $this->product->tags;
        $this->status = $this->product->status;
        $this->attr_data = $this->product->attributes;
    }

    public function render()
    {
        $attributes = ['color', 'body color', 'mina color', 'size', 'type'];
        $categories = Category::Active()->OrderBY('name')->get();
        return view('livewire.backend.product.update')->with(['categories' => $categories, 'attributes' => $attributes]);
    }

    //add more row for attributes inputs
    public function addMoreAttributes() {
        $this->attr_data[] = ['type' => '', 'value' => ''];
    }

    //remove attribute inputs row
    public function removeAttribute($index)  {
        unset($this->attr_data[$index]);
        $this->attr_data = array_values($this->attr_data);
    }

    public function update() {
        $this->validate();
        try {
            DB::beginTransaction();

                $this->product->name = $this->name;
                $this->product->category_id = $this->category;
                $this->product->mini_description = $this->mini_description;
                $this->product->description = $this->description;
                $this->product->price = $this->price*100;
                $this->product->attributes = $this->attr_data;
                $this->product->tags = $this->tags;
                $this->product->status = $this->status;
                $this->product->admin_id = Auth::guard('admin')->user()->id;

                if($this->product->isDirty()) {
                    if($this->product->isDirty('status')) {
                        //update banners status dependes on category status
                        $this->product->banners()->update(['status' => $this->product->status]);
                    }

                    if($this->product->category->status != 'active' && $this->status == 'active') {
                        Session::flash('error','Sorry you can\'t activate product before activate product category');
                    }
                    else {
                        $this->product->save();
                        Notification::send(Admin::Active()->get(), new ProductNotification(Auth::guard('admin')->user()->id, 'updated'));
                        $this->emit('notifications');
                        Session::flash('success','Product Updated Successfully');
                    }
                }
                else {
                    Session::flash('error','No Changes To Update');
                }

                //logs stored when updated by productObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
        
    }

}