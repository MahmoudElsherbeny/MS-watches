<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Product;
use App\Product_image;
use App\Category;

class Create extends Component
{
    use WithFileUploads;

    public $name, $category, $mini_description, $description, $price;
    public $body_color, $mina_color, $tags, $status, $editorId;
    public $images = [];

    public $product;

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/',
        'mini_description' => 'required',
        'description' => 'required',
        'price' => 'required|numeric|gt:0',
        'body_color' => 'required|alpha',
        'mina_color' => 'required|alpha',
        'images' => 'required|array|max:4',
        'images.*' => 'max:8000|mimes:image/*,video/*',
    ];

    public function mount() {
        $this->editorId = Auth::guard('admin')->user()->id;
        $this->category = Category::orderBY('name')->first()->id;
        $this->tags = 'men';
        $this->status = 'active';
    }

    public function store() {
        
        $this->validate();
        //store product
        $this->product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category,
            'mini_description' => $this->mini_description,
            'description' => $this->description,
            'price' => $this->price*100,
            'old_price' => 0,
            'body_color' => $this->body_color,
            'mina_color' => $this->mina_color,
            'rate' => 0,
            'tags' => $this->tags,
            'status' => $this->status,
            'admin_id' => $this->editorId,
        ]);

        foreach ($this->images as $key => $image) {
            $filename = 'watche_'.$image->getClientOriginalName();
            $path = $image->storeAs('products',$filename);
            
            Product_image::create([
                'product_id' => $this->product->id,
                'image' => $path,
                'order' => 1,
            ]);
        }            

            //logs stored when created by product observer in app\observers

            Session::flash('success','product created successfully');
        
    }

    public function render()
    {
        $categories = Category::Where('status','active')->OrderBY('name')->get();
        return view('livewire.backend.product.create')->with('categories', $categories);
    }
}
