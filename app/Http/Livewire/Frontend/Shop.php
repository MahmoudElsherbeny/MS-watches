<?php

namespace App\Http\Livewire\Frontend;

use Livewire\WithPagination;
use Livewire\Component;
use App\Product;

class Shop extends Component
{
    use WithPagination;

    public $products;
    public $filter_count;
    public $products_count = 5;
    public $filters = [
        'categories' => [],
        'prices' => '',
        'sort' => '',
        'tags' => ''
    ];

    public function mount() {
        $this->products = Product::Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit($this->products_count)->get();
    }
    
    public function filtersNotEmpty(): bool {
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                return true;
            }
        }

        return false;
    }

    public function updatingFilters($value) {
        $this->products_count = 5;
    }

    public function hasMore() {
        return count($this->products) >= $this->products_count;
    }

    public function loadMore() {
        $this->products_count += 5;
    }

    public function render()
    {
        if($this->filtersNotEmpty()) {
            $this->products = Product::Where('status','active')
                                     ->WithFilters($this->filters)
                                     ->limit($this->products_count)->get();
        }
        else {

            $this->products = Product::Where('status','active')
                                     ->orderBy('id','DESC')
                                     ->limit($this->products_count)->get();
        }

        return view('livewire.frontend.shop');
    }

}
