<?php

namespace App\Http\Livewire\Frontend;

use Livewire\WithPagination;
use Livewire\Component;
use App\Product;

use DB;

class Shop extends Component
{
    use WithPagination;

    public $products;
    public $moreProducts;
    public $filter_count;
    public $hasmore = true;
    public $filters = [
        'categories' => [],
        'prices' => '',
        'sort' => '',
        'tags' => ''
    ];

    public function mount() {
       $this->products = Product::Where('status','active')
                                ->orderBy('id','DESC')
                                ->limit(80)->get();
    }
    
    public function loadMore($lastid) {
        if($lastid < 64) {
            $this->hasmore = false;
        }
        $this->moreProducts = Product::Where('status','active')
                                ->Where('id','<',$lastid)
                                ->orderBy('id','DESC')
                                ->paginate(80);

        $this->products = $this->products->merge($this->moreProducts);
    }
    /*
    public function getProductsProperty()
    {
        if (!empty(array_filter($this->filters['categories'])) ) {
            // this is where we remove the categories with a false value
            $this->filters['categories'] = array_filter($this->filters['categories']);
            return Product::Where('status','active')
                          ->WhereIn('category', array_keys($this->filters['categories']))->get();
            //return dd($this->filters['categories']);
        }

        return Product::Where('status','active')->orderBy('id','DESC')->limit(64)->get();
    }
    */

    public function render()
    {
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                $this->filter_count++;
            }
        }
        if($this->filter_count == 0) {
            $this->products = Product::Where('status','active')
                                    ->orderBy('id','DESC')
                                    ->limit(80)->get();
        }
        else if($this->filter_count > 0) {
            $this->products = Product::WithFilters($this->filters)->get();

            $this->hasmore = false;
        }
        /*
        foreach($this->filters as $key => $value) {
            if(!empty($value)) {
                $this->filter_count++;
            }
        }
        if($this->filter_count == 0) {
            $this->products = Product::Where('status','active')
                                    ->orderBy('id','DESC')
                                    ->limit(80)->get();
        }
        else if($this->filter_count == 1) {
            $this->products = Product::Where('status','active')->orderBy('id','DESC')->get();
        }

        if (!empty(array_filter($this->filters['categories'])) ) {
            // this is where we remove the categories with a false value
            $this->filters['categories'] = array_filter($this->filters['categories']);
            $this->products = $this->products->WhereIn('category', array_keys($this->filters['categories']));

            $this->hasmore = false;
        }

        if (!empty($this->filters['prices'])) {
            $priceFilter = $this->filters['prices'];
            $minPrice = explode(',', $priceFilter)[0];
            $maxPrice = explode(',', $priceFilter)[1];

            if($this->filter_count == 0) {
                $price_products = Product::WhereBetween('price', [$minPrice,$maxPrice]);
                $sale_products =  Product::WhereBetween('sale', [$minPrice,$maxPrice]);
                $this->products = $sale_products->merge($price_products);
            }
            else if($this->filter_count > 0) {
                $price_products = $this->products->WhereBetween('price', [$minPrice,$maxPrice]);
                $sale_products =  $this->products->WhereBetween('sale', [$minPrice,$maxPrice]);
                $this->products = $sale_products->merge($price_products);
            }

            $this->hasmore = false;
            //dd($priceFilter);
        }
        if (!empty($this->filters['sort'])) {
            if($this->filters['sort'] == 'rate') {
                $this->products = DB::table('products')
                                ->select('products.*', 'product_avg_rates.product', 'product_avg_rates.avg_rate')
                                ->join('product_avg_rates', 'product_avg_rates.product', '=', 'products.id')
                                ->Where('products.status', 'active')
                                ->orderBy('avg_rate','DESC');
            }
            else {
                $this->products = $this->products->SortByDesc($this->filters['sort']);
            }
            $this->hasmore = false;
        }
        if (!empty($this->filters['tags'])) {
            $this->products = $this->products->Where('tags', $this->filters['tags']);

            $this->hasmore = false;
        }
        */

        return view('livewire.frontend.shop')->with('products', $this->products);
    }

}
