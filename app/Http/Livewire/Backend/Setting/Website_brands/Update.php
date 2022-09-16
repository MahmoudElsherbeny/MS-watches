<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use App\Notifications\WebsiteBrandsNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use Exception;
use Illuminate\Validation\Rule;

class Update extends Component
{
    use WithFileUploads, ImageFunctions;

    public $name, $link, $status, $image;
    public $brand;

    public function rules() {
        return [
            'name' => [
                'required',
                'max:50',
                'min:3',
                'regex:/^[a-zA-Z0-9-\s]+$/',
                Rule::unique('website_brands')->ignore($this->brand->name, 'name'),
            ],
            'link' => 'required|url',
            'image' => 'nullable|max:8000|mimes:jpeg,bmp,png,jpg'
        ];
    }

    public function mount() {
        $this->name = $this->brand->name;
        $this->link = $this->brand->link;
        $this->status = $this->brand->status;
    }

    public function render()
    {
        return view('livewire.backend.setting.website_brands.update');
    }

    public function update() {
        $this->validate();
        try {
            DB::beginTransaction();

                $this->brand->name = $this->name;
                $this->brand->link = $this->link;
                $this->brand->status = $this->status;
                if($this->image) {
                    $this->brand->image ? $this->delete_if_exist($this->brand->image): '';
                    $this->brand->image = $this->store_image_path($this->image, 'setting/brands');
                }

                if($this->brand->isDirty()) {
                    $this->brand->save();
                    Notification::send(Admin::Active()->role('admin')->get(), new WebsiteBrandsNotification(Auth::guard('admin')->user()->id, 'updated'));
                    $this->emit('notifications');

                    Session::flash('success','Brand Updated Successfully');
                }
                else {
                    Session::flash('error','No Changes To Update');
                }
                //logs stored when updated by WebsiteBrandObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
    }
}
