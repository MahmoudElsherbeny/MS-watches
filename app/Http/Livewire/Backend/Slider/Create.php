<?php

namespace App\Http\Livewire\Backend\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\SlideNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Slide;
use App\Category;
use Exception;

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
        $this->link = 0;
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.backend.slider.create')->with('categories', Category::Active()->orderBY('name')->get());
    }

    public function store() {
        $values = $this->validate();

        try {
            DB::beginTransaction();

                Slide::create([
                    'image' => $this->store_image_path($this->image, 'slides'),
                    'title' => $this->title,
                    'subtitle' => $this->subtitle,
                    'order' => $this->order,
                    'status' => $this->status,
                    'link' => $this->link,
                ]);

                $this->resetExcept(['status', 'link']);
                Notification::send(Admin::Active()->get(), new SlideNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');
                    
                Session::flash('success','slide created successfully');
                //logs stored when created by SliderObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }
}