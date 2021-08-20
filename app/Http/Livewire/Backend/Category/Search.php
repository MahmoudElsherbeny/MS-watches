<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Category;

class Search extends Component
{
    public $cat_search;
    public $categories;

    public function mount() {
        $this->categories = Category::where('name','est')->get();
    }

    public function search() {
        $this->categories = Category::where('name','LIKE','%'.$this->cat_search."%")->orderBY('created_at','DESC')->paginate(30);
    }

    public function render()
    {
        return view('livewire.backend.category.search')->with(['categories' => $this->categories]);
    }
}
