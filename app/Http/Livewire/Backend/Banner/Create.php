<?php

namespace App\Http\Livewire\Backend\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\BannerNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Banner;
use App\Product;
use Exception;

class Create extends Component
{
    use WithFileUploads, ImageFunctions;

    public $product, $status, $image;

    protected $rules = [
        'product' => 'unique:banners,product_id',
        'image' => 'required|max:4000|mimes:jpeg,bmp,png,jpg',
    ];

    public function mount() {
        $this->product = Product::Active()->orderBY('name')->first()->id;
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.backend.banner.create')->with('products', Product::Active()->orderBY('name')->get());
    }

    public function store() { 
        $this->validate();

        try {
            DB::beginTransaction();

                Banner::create([
                    'product_id' => $this->product,
                    'status' => $this->status,
                    'image' => $this->store_image_path($this->image, 'banners'),
                ]);

                $this->resetExcept(['product', 'status']);
                Notification::send(Admin::Active()->get(), new BannerNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');

                Session::flash('success','New Banner added successfully');
                //logs stored when created by BannerObserver in app\observers

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }

    }
}
