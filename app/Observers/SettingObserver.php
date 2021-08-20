<?php

namespace App\Observers;

use App\Setting;
use App\Dashboard_log;
use Auth;

class SettingObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the setting "updated" event.   **/
    public function updated(Setting $setting)
    {
        // search for changes
        foreach ($setting->getChanges() as $attribute => $new_value) {

            //$setting_name = $setting->getOriginal('name');
            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'user' => Auth::guard('admin')->user()->id,
                    'log' => 'Update Setting '.$setting->name.' '.$attribute.' to '.$new_value,
                ]);
            }

        }
    }

}
