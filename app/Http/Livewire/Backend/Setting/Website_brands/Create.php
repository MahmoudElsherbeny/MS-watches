<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use App\Notifications\WebsiteBrandsNotification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Traits\ImageFunctions;
use App\Admin;
use App\Website_brand;
use Exception;

class Create extends Component
{
    use WithFileUploads, ImageFunctions;

    public $name, $link, $status, $image;

    protected $rules = [
        'name' => 'required|max:50|min:3|regex:/^[a-zA-Z0-9-\s]+$/|unique:website_brands,name',
        'link' => 'required|url',
        'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.backend.setting.website_brands.create');
    }

    public function store() {
        $this->validate();

        try {
            DB::beginTransaction();

                //store brand
                $path = $this->store_image_path($this->image, 'setting/brands');
                Website_brand::create([
                    'name' => $this->name,
                    'link' => $this->link,
                    'status' => $this->status,
                    'image' => $path,
                ]);

                $this->resetExcept('status');
                Notification::send(Admin::Active()->role('admin')->get(), new WebsiteBrandsNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');

                //logs stored when created by WebsiteBrand observer in app\observers
                Session::flash('success','brand added successfully');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
        
    }

}