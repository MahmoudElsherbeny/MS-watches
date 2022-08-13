<?php

namespace App\Http\Livewire\Backend\Slider;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;

use Livewire\Component;
use App\Slide;
use App\Category;
use App\Traits\ImageFunctions;

class Create extends Component
{
    use WithFileUploads, ImageFunctions;

    public $title, $subtitle, $order, $status, $link, $image;

    protected $rules = [
        'title' => 'required|max:100|min:3',
        'subtitle' => 'required',
        'order' => 'required|numeric|gt:0',
        'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->link = 'shop';
        $this->status = 'active';
    }

    public function store() {
        $this->validate();

        //store slides
        Slide::create([
            'image' => $this->store_image_path($this->image, 'slides'),
            'title' => $this->title,
            'sub_title' => $this->subtitle,
            'order' => $this->order,
            'status' => $this->status,
            'link' => $this->link,
        ]);
            
        //logs stored when created by slider observer in app\observers
        Session::flash('success','slide created successfully');  
    }

    public function render()
    {
        return view('livewire.backend.slider.create')->with('categories', Category::orderBY('name')->get());
    }
}
