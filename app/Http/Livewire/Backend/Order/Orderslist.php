<?php

namespace App\Http\Livewire\Backend\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

use App\Order;

class Orderslist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['status_change'];

    public $order_search, $from_search, $to_search, $status_search;
    public $admin;
    public $sort_field, $sort_dir;

    public function mount() {
        $this->from_search = (Carbon::now()->subDays(30))->format('Y-m-d');
        $this->to_search = date('Y-m-d');
        $this->admin = Auth::guard('admin')->user()->id;
        $this->sort_field = 'created_at';
        $this->sort_dir = 'desc';
    }

    public function status_change() {
        $this->render();
    }

    public function sortBy($field) {
        $this->sort_field = $field;
        $this->sort_dir = $this->sort_dir == 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {    
        $editor_open_orders = Auth::guard('admin')->user()->orders
                                  ->where('status', '!=', 'completed')
                                  ->where('status', '!=', 'cancel');

        $orders = Order::whereDate('created_at','>=',$this->from_search)
                        ->whereDate('created_at','<=',$this->to_search)
                        ->Where('status', 'like', '%'.$this->status_search.'%')
                        ->Where(function($query) {
                            $query->Where('name', 'like', '%'.$this->order_search.'%')
                                  ->orWhere('phone', 'like', '%'.$this->order_search.'%');
                        })
                        ->OrderBy($this->sort_field, $this->sort_dir)
                        ->paginate(50);

        return view('livewire.backend.order.orderslist')->with(['orders' => $orders, 'open_orders' => $editor_open_orders]);
    }
}
