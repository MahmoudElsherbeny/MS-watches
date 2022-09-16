<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use App\Notifications\ProductNotification;
use App\Traits\ImageFunctions;
use App\Admin;
use App\Product;
use Exception;

class Productslist extends Component
{
    use WithPagination, ImageFunctions;
    protected $paginationTheme = 'bootstrap';

    public $product_search, $sort_field, $sort_dir;
    public $new_price;

    protected $rules = [
        'new_price' => 'required|numeric|gt:0',
    ];

    public function mount() {
        $this->sort_field = 'created_at';
        $this->sort_dir = 'desc';
    }

    public function render()
    {
        $products = Product::select('id','name','category_id','price','old_price','status','admin_id','quantity','created_at','updated_at')
                           ->Search($this->product_search)->OrderBy($this->sort_field, $this->sort_dir)->paginate(2);
                           
        return view('livewire.backend.product.productslist')->with('products',$products);
    }

    public function sortBy($field) {
        $this->sort_field = $field;
        $this->sort_dir = $this->sort_dir == 'asc' ? 'desc' : 'asc';
    }

    //delete function - delete product data and it's images, reviews
    public function destroy($id) {
        $product = Product::findOrFail($id);
        try {
            DB::beginTransaction();
                foreach($product->product_images as $img) {
                    $this->delete_if_exist($img->image);
                }
                $product->product_images->each->delete();
                foreach($product->banners as $banner) {
                    $this->delete_if_exist($banner->image);
                }
                $product->banners->each->delete();
                $product->product_reviews->each->delete();
                $product->products_stores->each->delete();
                $product->delete();

                Notification::send(Admin::Active()->get(), new ProductNotification(Auth::guard('admin')->user()->id, 'deleted it\'s related'));
                $this->emit('notifications');

                //logs stored when deleted by ProductObserver in app\observers
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }

    //sale function - make discount on product price
    public function sale($id) {
        $this->validate();

        $product = Product::findOrfail($id);
        try {
            DB::beginTransaction();
                if($this->new_price < $product->price/100) {
                    $product->old_price = $product->price;
                    $product->price = $this->new_price * 100;
                    $product->save();

                    $this->reset('new_price');
                    Notification::send(Admin::Active()->get(), new ProductNotification(Auth::guard('admin')->user()->id, 'updated for sale'));
                    $this->emit('notifications');
                }

                //logs stored when updated by ProductObserver in app\observers
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }  
    }

}