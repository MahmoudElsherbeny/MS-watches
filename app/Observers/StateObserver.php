<?php

namespace App\Observers;

use App\State;
use App\Dashboard_log;
use Auth;

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
                'user' => Auth::guard('admin')->user()->id,
                'log' => 'create new state '.$state->state,
            ]);
        }
    }

}
