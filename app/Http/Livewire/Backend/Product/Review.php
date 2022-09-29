<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use App\Website_review;
use App\Product_review;

class Review extends Component
{
    public function add_website_review($review_id) { 
        Website_review::create([
            'product_review_id' => $review_id,
            'status' => 'active',
        ]);            
        //logs stored when created by website review observer in app\observers  
    }

    public function render()
    {
        $products_reviews = Product_review::orderBY('rate','DESC')->paginate(50);
        return view('livewire.backend.product.review')->with('products_reviews', $products_reviews);
    }
}
