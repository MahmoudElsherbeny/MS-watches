<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Livewire\WithPagination;

use App\Product;

class Productslist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $product_search;
    public $new_price;

    protected $rules = [
        'new_price' => 'required|numeric|gt:0',
    ];

    private function resetInputFields(){
        $this->new_price = '';
    }

    //delete function - delete product data and it's images, reviews
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product_images = $product->product_images;
        $product_reviews = $product->product_reviews;
        foreach($product_images as $img) {
            Storage::Delete($img->image);
        }
        $product->delete();
        $product_images->each->delete();
        $product_reviews->each->delete();

        //logs stored when deleted by ProductObserver in app\observers
    }

    //sale function - make discount on product price
    public function sale($id) {
        $this->validate();

        $product = Product::find($id);
        if($product) {
            $product->old_price = $product->price;
            $product->price = $this->new_price * 100;
            $product->save();

            $this->resetInputFields();
        }

        //logs stored when updated by ProductObserver in app\observers
        return Redirect::back();
    }

    public function render()
    {
        $products = Product::select('id','name','category_id','price','old_price','status','admin_id','quantity','created_at','updated_at')
                           ->Where('name', 'like', '%'.$this->product_search.'%')
                           ->OrderBy('created_at','DESC')->get();
        return view('livewire.backend.product.productslist')->with('products',$products);
    }
}
