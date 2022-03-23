<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Product;

class Shop extends Component
{

    //public $products;
    public $moreProducts;
    public $hasmore = true;
    public $filters = [
        'categories' => []
    ];

    public function mount() {
        /*$this->products = Product::Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit(64)
                                ->get();*/

    }
    
    public function loadMore($lastid) {
        $this->moreProducts = Product::Where('status','active')
                                ->Where('id','<',$lastid)
                                ->orderBy('id','DESC')
                                ->limit(64)
                                ->get();

        $this->products = $this->products->merge($this->moreProducts);
        if($lastid < 64) {
            $this->hasmore = false;
        }
    }

    public function getProductsProperty()
    {
        if (empty($this->filters['categories'])) {
            return Product::Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit(64)
                                ->get();
        }

        // this is where we remove the categories with a false value
        $this->filters['categories'] = array_filter($this->filters['categories']);
        $this->hasmore = false;
        return Product::Where('status','active')
                      ->whereIn('category', array_keys($this->filters['categories']))->get();
    }

    /*
    public function priceFilter($minPrice,$maxPrice) {
        $this->products = Product::Where('status','active')
                                ->WhereBetween('price', [$minPrice,$maxPrice])
                                ->orWhereBetween('sale', [$minPrice,$maxPrice])
                                ->orderBy('id','DESC')
                                ->get();

        $this->hasmore = false;
    }
    */

    public function render()
    {
        return view('livewire.frontend.shop')->extends('frontend.layouts.app');
    }

}
