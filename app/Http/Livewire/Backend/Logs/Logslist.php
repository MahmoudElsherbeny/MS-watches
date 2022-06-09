<?php

namespace App\Http\Livewire\Backend\Logs;

use App\Dashboard_log;
use Livewire\Component;

class Logslist extends Component
{
    public $logs_search;

    public function render()
    {
        if($this->logs_search) {
            $logs = Dashboard_log::whereDate('date','=',$this->logs_search)->orderBY('date','DESC')->paginate(50);
        }
        else {
            $logs = Dashboard_log::orderBY('date','DESC')->paginate(50);
        }
            
        return view('livewire.backend.logs.logslist')->with('logs',$logs);
    }
}
