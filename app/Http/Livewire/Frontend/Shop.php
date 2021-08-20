<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Product;

class Shop extends Component
{

    public $products;
    public $amount = 136;
    public $hasmore = true;

    public function mount() {
        $this->products = Product::Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit(68)
                                ->get();
    }
    
    public function loadMore($lastid) {
        $this->products = Product::Where('id','<=',$lastid)
                                ->Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit($this->amount)
                                ->get();

        $this->amount += 68;
        if($this->amount >= $lastid) {
            $this->hasmore = false;
        }
    }

    public function render()
    {
        return view('livewire.frontend.shop')->extends('frontend.layouts.app');
    }

}
