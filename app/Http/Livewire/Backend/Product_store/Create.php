<?php

namespace App\Http\Livewire\Backend\Product_store;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductStoreNotification;
use App\Admin;
use App\Product;
use App\Products_store;
use Exception;

class Create extends Component
{
    public $product, $quantity, $total;

    protected $rules = [
        'quantity' => 'required|numeric|min:1',
        'total' => 'required|numeric|min:1',
    ];

    public function mount() {
        $this->product = Product::Active()->OrderBy('name')->first()->id;
    }

    public function render() {
        $products = Product::Active()->select('id','name','all_quantity','quantity')->OrderBy('name')->get();
        return view('livewire.backend.product_store.create')->with(['products' => $products]);
    }

    public function store() { 
        $this->validate();

        $product = Product::findOrFail($this->product);
        try {
            DB::beginTransaction();
                $new_quantity = Products_store::create([
                    'product_id' => $this->product,
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'quantity' => $this->quantity,
                    'unit_price' => $this->total*100 / $this->quantity,
                    'total' => $this->total*100,
                ]);

                $product->increment('all_quantity', $new_quantity->quantity);
                $product->increment('quantity', $new_quantity->quantity);

                $this->resetExcept('product');
                Notification::send(Admin::Active()->get(), new ProductStoreNotification(Auth::guard('admin')->user()->id, 'added'));
                $this->emit('notifications');
                Session::flash('success','New product quantity added successfully');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error: '.$e->getMessage());
        }
    }
}
