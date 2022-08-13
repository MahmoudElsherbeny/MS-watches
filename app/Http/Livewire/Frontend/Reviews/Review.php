<?php

namespace App\Http\Livewire\Frontend\Reviews;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Product_review;
use Illuminate\Support\Facades\Redirect;

class Review extends Component
{
    public $productId, $product;
    public $user;
    public $rate, $review, $reviews = [];
    public $user_review, $edit_rate, $edit_review;

    protected $rules = [
        'edit_rate' => 'required',
        'review' => 'max:250',
    ];

    public function mount() {
        $this->product = Product::findOrFail($this->productId);
        if(Auth::check()) {
            $this->user = Auth::user()->id;
            $this->user_review = $this->product->product_reviews()->where('user_id', $this->user)->first();
            if($this->user_review) {
                $this->edit_rate = $this->user_review->rate;
                $this->edit_review = $this->user_review->review;
            }

            $this->reviews = $this->product->product_reviews()
                                           ->orderByRaw("user_id = $this->user DESC")
                                           ->OrderBy('created_at','DESC')->get();
        }
        else {
            $this->reviews = $this->product->product_reviews()->OrderBy('created_at','DESC')->get();
        }
    }

    //store function - store user review for an product
    public function store() {
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
        $this->reviews = $this->product->product_reviews()
                                       ->orderByRaw("user_id = $this->user DESC")
                                       ->OrderBy('created_at','DESC')->get();
    }

    //update function - update user review for an product
    public function update() {

        $this->user_review->review = $this->edit_review;
        $this->user_review->rate = $this->edit_rate;
        if($this->user_review->isDirty()) {
            $this->user_review->save();
        }

        //rate average stored when review created by ProductReview observer in app\observers
        
        //show user review after submit
        $this->reviews = $this->product->product_reviews()
                                       ->orderByRaw("user_id = $this->user DESC")
                                       ->OrderBy('created_at','DESC')->get();
    }

    public function render()
    {
        return view('livewire.frontend.reviews.review');
    }
}
