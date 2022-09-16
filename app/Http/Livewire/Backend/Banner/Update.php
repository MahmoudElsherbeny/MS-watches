<?php

namespace App\Http\Livewire\Backend\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\BannerNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Product;
use Exception;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $product, $status, $image;
    public $banner;

    protected $rules = [
        'image' => 'nullable|max:4000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->product = $this->banner->product->name;
        $this->status = $this->banner->status;
    }

    public function render()
    {
        return view('livewire.backend.banner.update');
    }

    public function update() { 
        $this->validate();

        try {
            DB::beginTransaction();

                $this->banner->status = $this->status;
                if($this->image) {
                    $this->delete_if_exist($this->image);
                    $this->banner->image = $this->store_image_path($this->image, 'banners');
                }

                if($this->banner->isDirty()) {
                    if($this->banner->product->status !='active' && $this->status == 'active') {
                        Session::flash('error','Sorry you can\'t activate banner before activate banner product');
                    }
                    else {
                        $this->banner->save();
                        Notification::send(Admin::Active()->get(), new BannerNotification(Auth::guard('admin')->user()->id, 'updated'));
                        $this->emit('notifications');
                        Session::flash('success','Banner Updated Successfully');
                    }
                }
                else {
                    Session::flash('error','No Changes To Update');
                }
            
                //logs stored when updated by BannerObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }

    }
}