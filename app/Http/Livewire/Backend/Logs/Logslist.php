<?php

namespace App\Http\Livewire\Backend\Logs;

use App\Dashboard_log;
use Livewire\Component;

class Logslist extends Component
{
    public $logs_search;

    public function render()
    {
        $logs = $this->logs_search
            ? Dashboard_log::whereDate('date','=',$this->logs_search)->orderBY('date','DESC')->paginate(50)
            : Dashboard_log::orderBY('date','DESC')->paginate(50);
            
        return view('livewire.backend.logs.logslist')->with('logs',$logs);
    }
}
