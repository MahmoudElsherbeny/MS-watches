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
    public $products_loadMoreCount = 5;
    public $hasmore = true;
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
    
    public function loadMore() {
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                $this->filter_count++;
            }
        }
        if($this->filter_count > 0) {
            if(in_array(200, $this->filters)) {
                $this->products_loadMoreCount = 5;
            }
            $this->products_loadMoreCount += 5;
            $this->hasmore = true;
        }
        else {
            if(count($this->products) < $this->products_count) {
                $this->hasmore = false;
            }
            else {
                $this->products_count += 5;
                $this->hasmore = true;
            }
        }
    }

    public function render()
    {
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                $this->filter_count++;
            }
        }
        if($this->filter_count > 0) {
            if(count($this->products) < $this->products_loadMoreCount) {
                $this->hasmore = false;
            }
            $this->products = Product::Where('status','active')
                                     ->WithFilters($this->filters)
                                     ->limit($this->products_loadMoreCount)->get();
        }
        else {
            $this->products = Product::Where('status','active')
                                     ->orderBy('id','DESC')
                                     ->limit($this->products_count)->get();
        }
        dd(array_values($this->filters) && array_values($this->filters['categories']) == null);

        return view('livewire.frontend.shop');
    }

}
