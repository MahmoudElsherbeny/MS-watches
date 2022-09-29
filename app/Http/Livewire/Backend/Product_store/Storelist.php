<?php

namespace App\Http\Livewire\Backend\Product_store;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;

class Storelist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $store_search;
    public $sort_field, $sort_dir;

    public function mount() {
        $this->sort_field = 'created_at';
        $this->sort_dir = 'desc';
    }

    public function render()
    {
        $products = Product::select('id','name','all_quantity','quantity', 'created_at', 'updated_at')
                           ->Search($this->store_search)
                           ->OrderBy($this->sort_field, $this->sort_dir)->paginate(50);
        return view('livewire.backend.product_store.storelist')->with('products',$products);
    }

    public function sortBy($field) {
        $this->sort_field = $field;
        $this->sort_dir = $this->sort_dir == 'asc' ? 'desc' : 'asc';
    }
}
