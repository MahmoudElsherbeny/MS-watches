<?php

namespace App\Http\Livewire\Backend\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

use Livewire\Component;
use App\Slide;
use App\Category;

use Session;
use Redirect;

class Update extends Component
{
    use WithFileUploads;

    public $slide;
    public $title;
    public $subtitle;
    public $order;
    public $status;
    public $link;

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
        if($this->slide != null) {
            $this->slide->title = $this->title;
            $this->slide->sub_title = $this->subtitle;
            $this->slide->order = $this->order;
            $this->slide->status = $this->status;
            $this->slide->link = $this->link;
            $this->slide->save();

            //logs stored when updated by slider observer in app\observers

            Session::flash('success','Slide Updated Successfully');
        }
        else {
            Session::flash('error','Slide Not Exist');
        }
        return Redirect::route('slider.edit', ['id' => $this->slide->id]);
        
    }

    public function render()
    {
        return view('livewire.backend.slider.update')->with('categories', Category::orderBY('name')->get());
    }
}
