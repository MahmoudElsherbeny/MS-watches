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

    public function render()
    {
        $products = Product::select('id','name','all_quantity','quantity', 'created_at', 'updated_at')
                           ->Where('name', 'like', '%'.$this->store_search.'%')
                           ->OrderBy('updated_at','DESC')->paginate(30);
        return view('livewire.backend.product_store.storelist')->with('products',$products);
    }
}
