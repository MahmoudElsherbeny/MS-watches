<?php

namespace App\Http\Livewire\Frontend\Reviews;

use Livewire\Component;
use App\Product;
use App\Product_review;
use Auth;
use Redirect;

class Create extends Component
{
    public $product;
    public $rate;
    public $review;
    public $user;
    public $productId;
    public $reviews = [];

    protected $rules = [
        'rate' => 'required',
        'review' => 'max:250',
    ];

    public function mount() {
        $this->product = Product::findOrFail($this->productId);
        if(Auth::check()) {
            $this->user = Auth::user()->id;
            $this->reviews = $this->product->product_reviews()->orderByRaw("user_id = $this->user DESC")
                                                              ->OrderBy('created_at','DESC')->get();
        }
        else {
            $this->reviews = $this->product->product_reviews()->OrderBy('created_at','DESC')->get();
        }
    }

    //review store function - store user review for an product
    public function review_store() {

        $this->validate();
        
        //store product
        Product_review::create([
            'user_id' => $this->user,
            'product_id' => $this->productId,
            'review' => $this->review,
            'rate' => $this->rate,
        ]);

        //rate average stored when review created by ProductReview observer in app\observers

        //show user review after submit
        $this->reviews = $this->product->product_reviews()->orderByRaw("user_id = $this->user DESC")
                                                          ->OrderBy('created_at','DESC')->get();

        return Redirect::back();
    }

    public function render()
    {
        return view('livewire.frontend.reviews.create')->extends('frontend.layouts.app');
    }
}
