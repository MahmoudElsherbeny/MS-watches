<?php

namespace App\Observers;

use App\Website_review;
use App\Dashboard_log;
use Illuminate\Support\Facades\Auth;

class WebsiteReviewObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the website review "created" event.   **/
    public function created(Website_review $review)
    {
        //store logs when website review created
        if ($review->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'make product ('.$review->product_review->product->name.') review as website review ',
            ]);
        }
    }

    /**   Handle the website review "updated" status event.   **/
    public function updated(Website_review $review)
    {
        // search for changes
        foreach ($review->getChanges() as $attribute => $new_value) {
            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update website review '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the website review "deleted" event.   **/
    public function deleted(Website_review $review)
    {
        //store logs when review deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'remove review as website review ',
        ]);
    }
    
}
