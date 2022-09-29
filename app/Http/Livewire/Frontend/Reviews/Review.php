<?php

namespace App\Http\Livewire\Frontend\Reviews;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Product_review;

class Review extends Component
{
    public $product;
    public $rate, $review, $reviews = [];
    public $user_review, $edit_rate, $edit_review;

    protected $rules = [
        'review' => 'max:250',
    ];

    public function mount() {
        if(Auth::check()) {
            $this->user_review = $this->product->product_reviews()->where('user_id', Auth::id())->first();
            if($this->user_review) {
                $this->edit_rate = $this->user_review->rate;
                $this->edit_review = $this->user_review->review;
            }
            else {
                $this->edit_rate = 1;
            }
        }
    }

    public function render()
    {
        $this->reviews = Auth::check()
        ? $this->product->product_reviews()->orderByRaw("user_id = ".Auth::id()." DESC")->OrderBy('created_at','DESC')->get()
        : $this->product->product_reviews()->OrderBy('created_at','DESC')->get();

        return view('livewire.frontend.reviews.review')->with(['reviews' => $this->reviews]);
    }

    //store function - store user review for an product
    public function store() {
        $this->validate();
        
        Product_review::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
            'review' => $this->review,
            'rate' => $this->rate,
        ]);

        //rate average stored when review created by ProductReview observer in app\observers
    }

    //update function - update user review for an product
    public function update() {
        $review = $this->product->product_reviews()->where('user_id', Auth::id())->first();
        $review->review = $this->edit_review;
        $review->rate = $this->edit_rate;
        $review->isDirty() ? $review->save() : '';

        //rate average stored when review created by ProductReview observer in app\observers
    }
}