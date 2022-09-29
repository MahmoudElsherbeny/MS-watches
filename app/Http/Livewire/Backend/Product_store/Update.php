<?php

namespace App\Http\Livewire\Backend\Product_store;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductStoreNotification;
use App\Admin;
use App\Order_item;
use App\Product;
use Exception;

class Update extends Component
{
    public $product_store, $quantity, $total;

    protected $rules = [
        'quantity' => 'required|numeric|min:1',
        'total' => 'required|numeric|min:1',
    ];

    public function mount()
    {
        $this->quantity = $this->product_store->quantity;
        $this->total = $this->product_store->total/100;
    }

    public function render()
    {
        return view('livewire.backend.product_store.update');
    }

    public function update() { 
        $this->validate();

        $product = Product::find($this->product_store->product_id);
        try {
            $diff_quantity = $this->quantity - $this->product_store->quantity;
            if(Order_item::getCountOrdersAfterQtyAdd($this->product_store->product_id, $this->product_store->updated_at) > 0) {
                Session::flash('error','you cant edit this quantity because there are orders set');
            }
            elseif(($product->quantity + $diff_quantity) <= 0) {
                Session::flash('error','Product quantity will be under 0 with this quantity update');
            }
            else {
                DB::beginTransaction();
                    $this->product_store->admin_id = Auth::guard('admin')->user()->id;
                    $this->product_store->quantity = $this->quantity;
                    $this->product_store->unit_price = $this->total*100 / $this->quantity;
                    $this->product_store->total = $this->total*100;
                    $this->product_store->save();

                    $product->increment('all_quantity', $diff_quantity);
                    $product->increment('quantity', $diff_quantity);

                    Notification::send(Admin::Active()->role('admin')->get(), new ProductStoreNotification(Auth::guard('admin')->user()->id, 'updated'));
                    $this->emit('notifications');
                    Session::flash('success','Product quantity updated successfully');
                DB::commit();
            }

        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error','Error:'.$e);
        }

    }
}
