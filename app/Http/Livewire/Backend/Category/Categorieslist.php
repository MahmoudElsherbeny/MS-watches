<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Product;
use App\Traits\ImageFunctions;

class Categorieslist extends Component
{
    use ImageFunctions;
    public $category_search;

    //function destroy - delete category and it's all products
    public function destroy($id)
    {
        //delete category, category product's and it's images
        $category = Category::find($id);
        $category_products = Category::find($id)->products;
        foreach ($category_products as $prod) {
            $product_images = Product::find($prod->id)->product_images;
            $product_reviews = Product::find($prod->id)->product_reviews;
            foreach ($product_images as $img) {
                $this->delete_if_exist($img->image);
                $img->delete();
            }
            $product_reviews->each->delete();
            $prod->delete();
        }
        $category->delete();

        //logs stored when deleted by CategoryObserver in app\observers
    }

    public function render()
    {
        $categories = Category::Where('name', 'like', '%'.$this->category_search.'%')->get();
        return view('livewire.backend.category.categorieslist')->with('categories',$categories);
    }
}
