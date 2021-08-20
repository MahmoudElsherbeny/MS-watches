<?php

namespace App\Http\Livewire\Backend\Slider;
use Livewire\WithFileUploads;

use Livewire\Component;
use App\Slide;
use App\Category;

use Session;
use Redirect;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $order;
    public $status;
    public $link;
    public $image;

    public $filename;

    protected $rules = [
        'title' => 'required|max:100|min:3',
        'subtitle' => 'required',
        'order' => 'required|numeric|gt:0',
        'image' => 'required|max:5000',
    ];

    public function mount() {
        $this->link = 'shop';
        $this->status = 'active';
    }

    public function store() {
        
        $this->validate();
        //store slide
        $this->filename = 'slide'.time().'.'.$this->image->getClientOriginalExtension();
        $this->image->storeAs('public/slides',$this->filename);
        Slide::create([
            'image' => $this->filename,
            'title' => $this->title,
            'sub_title' => $this->subtitle,
            'order' => $this->order,
            'status' => $this->status,
            'link' => $this->link,
        ]);
            
        //logs stored when created by slider observer in app\observers

        Session::flash('success','slide created successfully');
        
        return Redirect::route('slider.create');
    }

    public function render()
    {
        return view('livewire.backend.slider.create')->with('categories', Category::orderBY('name')->get());
    }
}
