<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use App\Product;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Products extends LivewireDatatable
{
    public $model = Product::class;

    public function builder()
    {
        //
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('IDts'),
            // Column that counts every line from 1 upwards, independent of content
            //Column::index($this),
            Column::delete()
        ];
    }

    public function render()
    {
        return view('livewire.backend.product.products');
    }

}