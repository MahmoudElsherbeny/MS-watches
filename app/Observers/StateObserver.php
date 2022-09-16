<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\State;
use App\Dashboard_log;

class StateObserver
{ 
    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the state "created" event.   **/
    public function created(State $state)
    {
        //store logs when state created
        if ($state->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'log' => 'create new state '.$state->state,
            ]);
        }
    }

    /**   Handle the state "updated" event.   **/
    public function updated(State $state)
    {
        // search for changes
        foreach ($state->getChanges() as $attribute => $new_value) {

            $state_name = $state->getOriginal('state');
            if ($attribute != 'updated_at') {
                Dashboard_Log::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'log' => 'Update state '.$state_name.' '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the state "deleted" event.   **/
    public function deleted(State $state)
    {
        //store logs when state deleted
        Dashboard_log::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'log' => 'Delete state '.$state->state,
        ]);
    }

}
