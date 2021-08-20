<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Product;
use App\Dashboard_log;
use App\Admin;
use Auth;
use Session;
use Redirect;
use DB;

class CategoryCtrl extends Controller
{
    //function index - show categories page and categories live search
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $categories = Category::where('name','LIKE','%'.$request->cat_search."%")->orderBY('created_at','DESC')->get();
            $catCount = count($categories);
            $returnCategories = view('backend.category.search')->with('categories',$categories)->render();
            return Response()->json(['data'=>$returnCategories, 'count'=>$catCount]);
        }
        else {
            $categories = Category::orderBY('created_at','DESC')->get();
            return view('backend.category.list')->with('categories',$categories);
        }
    }

    //function creat - show create new category page
    public function create() {
        return view('backend.category.create');
    }

    //store category data with livewire in livewire/backend/category/create

    //function edit - show edit category page
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.update')->with('category',$category);
    }

    //update category data with livewire in livewire/backend/category/update
    


    //function destroy - delete category and it's all products
    public function destroy($id) {

        //delete category
        $category = Category::find($id);
        $category->delete();
        
        //delete category product's and it's images
        $query = 'DELETE products,product_images FROM products 
                  INNER JOIN product_images 
                  ON product_images.product = products.id  
                  WHERE products.category = ?';
        DB::delete($query, array($id));

        //delete category product's images from there directory
        $product_images = DB::table('products')
            ->select('products.id', 'products.name', 'products.category', 'product_images.id', 'product_images.product', 'product_images.image')
            ->join('product_images', 'product_images.product', '=', 'products.id')
            ->Where('products.category', $id);
        $products = $product_images->get();
        foreach($products as $prod_img) {
            Storage::Delete('public/products/'.$prod_img->image);
        }

        //logs stored when deleted by category observer in app\observers

        return Redirect::route('category.index');
    }

}
