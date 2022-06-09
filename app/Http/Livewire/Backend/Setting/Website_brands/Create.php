<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Website_brand;
use Illuminate\Support\Facades\Session;

class Create extends Component
{

    use WithFileUploads;

    public $name, $link, $status, $image;

    protected $rules = [
        'name' => 'required|max:100|min:3|regex:/^[a-zA-Z0-9-\s]+$/',
        'link' => 'required|url',
        'image' => 'required|max:8000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->status = 'active';
    }

    public function store() {
        
        $this->validate();
        $brandExist = Website_brand::Where('name',$this->name)
                                   ->OrWhere('image', 'setting/brands/brand'.$this->image->getClientOriginalName())->first();
        if(!$brandExist) {
            //store brand
            $filename = 'brand'.$this->image->getClientOriginalName();
            $path = $this->image->storeAs('setting/brands', $filename);
            Website_brand::create([
                'name' => $this->name,
                'link' => $this->link,
                'status' => $this->status,
                'image' => $path,
            ]);           

            //logs stored when created by WebsiteBrand observer in app\observers
            Session::flash('success','brand added successfully');
        }
        else {
            Session::flash('error','brand name or logo already exist');
        }
        
    }

    public function render()
    {
        return view('livewire.backend.setting.website_brands.create');
    }
}
