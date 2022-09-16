<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\Dashboard_log;

class BannerObserver
{
    /**   Handle the banner "created" event.   **/
    public function created(Banner $banner)
    {
        //store logs when banner created
        if ($banner->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'create new home banner '.$banner->image,
            ]);
        }
    }

    /**   Handle the banner "updated" event.   **/
    public function updated(Banner $banner)
    {
        // search for changes
        foreach ($banner->getChanges() as $attribute => $new_value) {

            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update banner ('.$banner->id.') '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the banner "deleted" event.   **/
    public function deleted(banner $banner)
    {
        //store logs when banner deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete banner '.$banner->image,
        ]);
    }

}
