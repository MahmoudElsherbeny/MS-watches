<?php

namespace App\Observers;
use Illuminate\Support\Facades\Auth;

use App\Slide;
use App\Dashboard_log;

class SliderObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the slide "created" event.   **/
    public function created(Slide $slide)
    {
        //store logs when slide created
        if ($slide->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'create new slide '.$slide->image,
            ]);
        }
    }

    /**   Handle the slide "updated" event.   **/
    public function updated(Slide $slide)
    {
        // search for changes
        foreach ($slide->getChanges() as $attribute => $new_value) {

            $slide_name = $slide->getOriginal('title');
            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update slide ('.$slide_name.') '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the slide "deleted" event.   **/
    public function deleted(Slide $slide)
    {
        //store logs when slide deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete slide '.$slide->image,
        ]);
    }

}
