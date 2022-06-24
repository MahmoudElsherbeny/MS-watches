<?php

namespace App\Observers;

use App\Dashboard_log;
use App\Website_brand;
use Illuminate\Support\Facades\Auth;

class WebsiteBrandObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the website brand "created" event.   **/
    public function created(Website_brand $brand)
    {
        //store logs when website brand created
        if ($brand->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'add brand ('.$brand->name.') as one of website brands ',
            ]);
        }
    }

    /**   Handle the website brand "updated" event.   **/
    public function updated(Website_brand $brand)
    {
        // search for changes
        foreach ($brand->getChanges() as $attribute => $new_value) {

            $brand_name = $brand->getOriginal('name');
            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update brand '.$brand_name.' '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the website brand "deleted" event.   **/
    public function deleted(Website_brand $brand)
    {
        //store logs when brand deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'remove brand ('.$brand->name.') from website brands ',
        ]);
    }

}
