<?php

namespace App\Http\Livewire\Backend\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Counter extends Component
{
    protected $listeners = ['notifications' => 'render'];

    public function render()
    {
        $unreadnotifications_count = count(Auth::guard('admin')->user()->unreadSubnotifications);
        return view('livewire.backend.notifications.counter')->with('unreadnotifications_count', $unreadnotifications_count);
    }
}
