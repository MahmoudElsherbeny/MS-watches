<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Product;
use App\Product_image;
use App\Category;
use Session;
use Redirect;
use Auth;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $category;
    public $mini_description;
    public $description;
    public $price;
    public $sale = 0;
    public $body_color;
    public $mina_color;
    public $status;
    public $editorId;
    public $images = [];

    public $product;
    public $filename;
    public $order = 1;

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/',
        'mini_description' => 'required',
        'description' => 'required',
        'price' => 'required|numeric|gt:0',
        'body_color' => 'required|alpha',
        'mina_color' => 'required|alpha',
        'images' => 'required|array|max:4',
        'images.*' => 'max:8000'    //mimetypes:image/*,video/*|
    ];

    public function mount() {
        $this->editorId = Auth::guard('admin')->user()->id;
        $this->category = Category::orderBY('name')->first()->id;
        $this->status = 'active';
    }

    public function store() {
        
        $this->validate();
        //store product
        $this->product = Product::create([
            'name' => $this->name,
            'category' => $this->category,
            'mini_description' => $this->mini_description,
            'description' => $this->description,
            'price' => $this->price,
            'sale' => $this->sale,
            'body_color' => $this->body_color,
            'mina_color' => $this->mina_color,
            'status' => $this->status,
            'published_by' => $this->editorId,
        ]);


        foreach ($this->images as $key => $image) {
            $this->filename = 'watche'.$this->product->id.($key+1).'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/products',$this->filename);
            
            Product_image::create([
                'product' => $this->product->id,
                'image' => $this->filename,
                'order' => $this->order,
            ]);
        }            

            //logs stored when created by product observer in app\observers

            Session::flash('success','product created successfully');
        
    }

    public function render()
    {
        return view('livewire.backend.product.create')->with('categories', Category::orderBY('name')->get());
    }
}
