<?php

namespace App\Observers;

use App\Ad;
use App\Dashboard_log;
use Illuminate\Support\Facades\Auth;

class AdObserver
{
    /**   Handle the ad "created" event.   **/
    public function created(Ad $ad)
    {
        //store logs when ad created
        if ($ad->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'create new home ad banner '.$ad->image,
            ]);
        }
    }

    /**   Handle the ad "updated" event.   **/
    public function updated(Ad $ad)
    {
        // search for changes
        foreach ($ad->getChanges() as $attribute => $new_value) {

            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update ad ('.$ad->id.') '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the ad "deleted" event.   **/
    public function deleted(ad $ad)
    {
        //store logs when ad deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete ad '.$ad->image,
        ]);
    }

}
