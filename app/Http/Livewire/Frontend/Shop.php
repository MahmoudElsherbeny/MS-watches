<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Product;

class Shop extends Component
{

    public $products;
    public $search_for;
    public $filter_count;
    public $products_count = 64;
    public $filters = [
        'categories' => [],
        'prices' => '',
        'sort' => '',
        'tags' => ''
    ];
    
    //check on filters array if it empty or not
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
        //check if there filter values
        if($this->filtersNotEmpty()) {
            //check if there search value in website search
            if(!$this->search_for) {
                //if there not value then display default products and enable filters
                $this->products = Product::Where('status','active')
                                        ->WithFilters($this->filters)
                                        ->limit($this->products_count)->get();
            }
            else {
                //if there value then display results and enable filters
                $this->products = Product::Where('status','active')
                                        ->WithFilters($this->filters)
                                        ->Where(function($query) {
                                            $query->Where('name','like','%'.$this->search_for.'%')
                                                ->OrWhere('tags','like','%'.$this->search_for.'%')
                                                ->OrWhere('body_color','like','%'.$this->search_for.'%')
                                                ->OrWhere('mina_color','like','%'.$this->search_for.'%');
                                        })
                                        ->limit($this->products_count)->get();
            }
        }
        else { // if there is no filters
            if(!$this->search_for) { //check if there search value in website search
                //if there not value then display default products
                $this->products = Product::Where('status','active')
                                        ->orderBy('id','DESC')
                                        ->limit($this->products_count)->get();
            }
            else {
                 //if there value then display results and enable filters
                $this->products = Product::Where('status','active')
                                         ->Where(function($query) {
                                             $query->Where('name','like','%'.$this->search_for.'%')
                                                 ->OrWhere('tags','like','%'.$this->search_for.'%')
                                                 ->OrWhere('body_color','like','%'.$this->search_for.'%')
                                                 ->OrWhere('mina_color','like','%'.$this->search_for.'%');
                                         })
                                         ->limit($this->products_count)->get();
                                        
            }
        }

        return view('livewire.frontend.shop')->with('products',$this->products);
    }

}
