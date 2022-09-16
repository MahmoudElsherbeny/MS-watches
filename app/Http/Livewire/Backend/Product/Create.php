<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use App\Notifications\ProductNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Category;
use App\Product;
use App\Product_image;
use Exception;

class Create extends Component
{
    use WithFileUploads, ImageFunctions;

    public $name, $category, $mini_description, $description, $price, $tags, $status;
    public $attr_data = [];
    public $images = [];

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/|unique:products',
        'mini_description' => 'required',
        'description' => 'required',
        'price' => 'required|numeric|gt:0',
        'images' => 'required|array|max:4',
        'images.*' => 'max:8000|mimes:jpeg,bmp,png,jpg,mp4,webm,mvp',
    ];

    public function mount() {
        $this->category = Category::Active()->orderBY('name')->first()->id;
        $this->tags = 'men';
        $this->status = 'active';
        $this->attr_data = [
            ['type' => '', 'value' => ''],
        ];
    }

    public function render()
    {
        $attributes = ['color', 'body color', 'mina color', 'size', 'type'];
        $categories = Category::Active()->OrderBY('name')->get();
        return view('livewire.backend.product.create')->with(['categories' => $categories, 'attributes' =>$attributes]);
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

    public function store() {
        $this->validate();

        try {
            DB::beginTransaction();
                
                $product = Product::create([
                    'name' => $this->name,
                    'category_id' => $this->category,
                    'mini_description' => $this->mini_description,
                    'description' => $this->description,
                    'price' => $this->price*100,
                    'old_price' => 0,
                    'attributes' => $this->attr_data,
                    'rate' => 0,
                    'tags' => $this->tags,
                    'status' => $this->status,
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'all_quantity' => 0,
                    'quantity' => 0,
                ]);

                foreach ($this->images as $key => $image) {
                    Product_image::create([
                        'product_id' => $product->id,
                        'image' => $this->store_unique_image_path($product->name.$key, $image, 'products'),
                        'order' => 1,
                    ]);
                }            

                $this->resetExcept(['category', 'status', 'tags']);
                Notification::send(Admin::Active()->get(), new ProductNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');

                Session::flash('success','product created successfully');
                //logs stored when created by ProductObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }

}
