<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

use App\Product;
use App\Product_image;
use App\Category;
use Session;
use Redirect;
use Auth;

class Products extends LivewireDatatable
{
    public $model = Product::class;

    function columns() {
        return [
            Column::name('name')->label('Name'),
            Column::name('category')->label('Category')
                
        ];
    }

    public function render()
    {
        return view('livewire.backend.product.products');
    }
}
