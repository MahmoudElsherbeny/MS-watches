<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use App\Traits\ImageFunctions;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

use App\Website_brand;

class Brandslist extends Component
{
    use ImageFunctions;

    public $brands;
    public $brand_search;

    function mount() {
        $this->brands = Website_brand::all();
    }

    //function destroy - delete brand feom website brands
    public function destroy($id) {
        $brand = Website_brand::findOrFail($id);
        $this->delete_if_exist($brand->image);
        $brand->delete();
        //logs in WebsiteBrandObserver in App\observers
    }

    public function render()
    {
        $this->brands = Website_brand::Where('name', 'like', '%'.$this->brand_search.'%')->get();
        return view('livewire.backend.setting.website_brands.brandslist');
    }
}
