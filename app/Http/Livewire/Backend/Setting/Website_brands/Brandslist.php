<?php

namespace App\Http\Livewire\Backend\Setting\Website_brands;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Traits\ImageFunctions;
use App\Notifications\WebsiteBrandsNotification;
use App\Admin;
use App\Website_brand;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Brandslist extends Component
{
    use ImageFunctions;

    public $brands;
    public $brand_search;

    function mount() {
        $this->brands = Website_brand::all();
    }

    public function render()
    {
        $this->brands = Website_brand::Where('name', 'like', '%'.$this->brand_search.'%')->get();
        return view('livewire.backend.setting.website_brands.brandslist');
    }

    //function destroy - delete brand feom website brands
    public function destroy($id) {
        try {
            DB::beginTransaction();
                $brand = Website_brand::findOrFail($id);
                $this->delete_if_exist($brand->image);
                $brand->delete();

                Notification::send(Admin::where('role', 'admin')->get(), new WebsiteBrandsNotification(Auth::guard('admin')->user()->id, 'deleted'));
                $this->emit('notifications');
                //logs in WebsiteBrandObserver in App\observers
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
    }

}
