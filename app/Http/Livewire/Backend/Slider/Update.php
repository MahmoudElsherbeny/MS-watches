<?php

namespace App\Http\Livewire\Backend\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

use Livewire\Component;
use App\Slide;
use App\Category;
use App\Traits\ImageFunctions;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $slide;
    public $title, $subtitle, $order, $status, $link, $image;

    protected $rules = [
        'title' => 'required|max:100|min:3',
        'subtitle' => 'required',
        'order' => 'required|numeric|gt:0',
    ];

    public function mount() {
        $this->title = $this->slide->title;
        $this->subtitle = $this->slide->sub_title;
        $this->order = $this->slide->order;
        $this->status = $this->slide->status;
        $this->link = $this->slide->link;
    }

    public function update() {
        
        $this->validate();
        if($this->slide) {
            $this->slide->title = $this->title;
            $this->slide->sub_title = $this->subtitle;
            $this->slide->order = $this->order;
            $this->slide->status = $this->status;
            $this->slide->link = $this->link;
            if($this->image) {
                $this->delete_if_exist($this->slide->image);
                
                $this->validate(['image' => 'max:8000|mimes:jpeg,bmp,png,jpg',]);
                $this->slide->image = $this->store_image_path($this->image, 'slides');
            }

            if($this->slide->isDirty()) {
                $this->slide->save();
                Session::flash('success','Slide Updated Successfully');
            }
            else {
                Session::flash('error','No Changes To Update');
            }

            //logs stored when updated by slider observer in app\observers
        }
        else {
            Session::flash('error','Slide Not Exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.slider.update')->with('categories', Category::orderBY('name')->get());
    }
}
