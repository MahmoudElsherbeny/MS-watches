<?php

namespace App\Http\Livewire\Backend\Editor;

use Livewire\Component;
use App\Admin;

class Editorslist extends Component
{
    public $editor_search;
    public $sort_field, $sort_dir;

    public function mount() {
        $this->sort_field = 'created_at';
        $this->sort_dir = 'desc';
    }

    public function render()
    {
        $editors = Admin::Search($this->editor_search)->OrderBy($this->sort_field, $this->sort_dir)->paginate(50);
        return view('livewire.backend.editor.editorslist')->with('editors', $editors);
    }

    public function sortBy($field) {
        $this->sort_field = $field;
        $this->sort_dir = $this->sort_dir == 'asc' ? 'desc' : 'asc';
    }
}
