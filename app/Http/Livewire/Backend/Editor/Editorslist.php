<?php

namespace App\Http\Livewire\Backend\Editor;

use App\Admin;
use Livewire\Component;

class Editorslist extends Component
{
    public $editor_search;

    public function render()
    {
        $editors = Admin::Where('name', 'like', '%'.$this->editor_search.'%')->orderBY('name','ASC')->paginate(30);
        return view('livewire.backend.editor.editorslist')->with('editors', $editors);
    }
}
