<?php

namespace App\Http\Livewire\Backend\Slider;

use App\Admin;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\SlideNotification;
use App\Traits\ImageFunctions;
use App\Slide;
use App\Category;
use Exception;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $slide;
    public $title, $subtitle, $order, $status, $link, $image;

    protected $rules = [
        'title' => 'required|max:100|min:3',
        'subtitle' => 'required',
        'order' => 'required|numeric|gt:0',
        'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->title = $this->slide->title;
        $this->subtitle = $this->slide->subtitle;
        $this->order = $this->slide->order;
        $this->status = $this->slide->status;
        $this->link = $this->slide->link;
    }

    public function render()
    {
        return view('livewire.backend.slider.update')->with('categories', Category::Active()->orderBY('name')->get());
    }

    public function update() {  
        $this->validate();
        
        try {
            DB::beginTransaction();
                
                $this->slide->title = $this->title;
                $this->slide->subtitle = $this->subtitle;
                $this->slide->order = $this->order;
                $this->slide->status = $this->status;
                $this->slide->link = $this->link;
                if($this->image) {
                    $this->delete_if_exist($this->slide->image);
                    $this->slide->image = $this->store_image_path($this->image, 'slides');
                }

                if($this->slide->isDirty()) {
                    $slide_category = $this->slide->link > 0 ? Category::findOrFail($this->slide->link) : '';
                    if($this->status = 'active' && $slide_category->status != 'active')  {
                        Session::flash('error','Sorry you can\'t activate slide before activate slide category');
                    }
                    else {
                        $this->slide->save();

                        Notification::send(Admin::Active()->get(), new SlideNotification(Auth::guard('admin')->user()->id, 'updated'));
                        $this->emit('notifications');
                        Session::flash('success','Slide Updated Successfully');
                    }
                }
                else {
                    Session::flash('error','No Changes To Update');
                }

                //logs stored when updated by SliderObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
        
    }

}
