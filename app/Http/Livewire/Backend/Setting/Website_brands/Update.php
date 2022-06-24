<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Website_brand;

class Update extends Component
{
    use WithFileUploads;

    public $name, $link, $status, $image;
    public $brand;

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/',
        'link' => 'required|url',
    ];

    public function mount() {
        $this->name = $this->brand->name;
        $this->link = $this->brand->link;
        $this->status = $this->brand->status;
    }

    public function update() {
        
        $this->validate();
        if($this->brand) {
            $this->brand->name = $this->name;
            $this->brand->link = $this->link;
            $this->brand->status = $this->status;
            if($this->image) {
                $filename = 'setting/brands/brand'.$this->image->getClientOriginalName();
                $existInStorage = Storage::exists($filename);
                if(!$existInStorage) {
                    $this->validate(['image' => 'max:8000|mimes:jpeg,bmp,png,jpg',]);
                    Storage::Delete($this->brand->image);
                    $filename = 'brand'.$this->image->getClientOriginalName();
                    $path = $this->image->storeAs('setting/brands', $filename);
                    $this->brand->image = $path;
                }
                else {
                    Session::flash('error','there are brand logo with the same name');
                }
            }

            if($this->brand->isDirty()) {
                $this->brand->save();
                Session::flash('success','Brand Updated Successfully');
            }
            else {
                Session::flash('error','No Changes To Update');
            }
            //logs stored when updated by WebsiteBrandObserver in app\observers

        }
        else {
            Session::flash('error','Brand Not Exist');
        }
        return Redirect::route('setting.brand_edit', ['id' => $this->brand->id]);
        
    }

    public function render()
    {
        return view('livewire.backend.setting.website_brands.update');
    }
}
