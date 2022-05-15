<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Product;

class Shop extends Component
{

    public $products;
    public $filter_count;
    public $products_count = 64;
    public $filters = [
        'categories' => [],
        'prices' => '',
        'sort' => '',
        'tags' => ''
    ];

    public function mount() {
        
    }
    
    public function filtersNotEmpty(): bool {
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                return true;
            }
        }

        return false;
    }

    //when changing filter return products count to 64
    public function updatingFilters() {
        $this->products_count = 64;
    }

    //check if there more product to load more
    public function hasMore() {
        return count($this->products) >= $this->products_count;
    }

    //increase count of products by click load more
    public function loadMore() {
        $this->products_count += 64;
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
