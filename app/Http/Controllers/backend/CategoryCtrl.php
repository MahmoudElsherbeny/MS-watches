<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Product;
use App\Dashboard_log;
use Redirect;

class CategoryCtrl extends Controller
{
    //function index - show categories page and categories live search
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::where('name', 'LIKE', '%' . $request->cat_search . "%")->orderBY('created_at', 'DESC')->get();
            $catCount = count($categories);
            $returnCategories = view('backend.category.search')->with('categories', $categories)->render();
            return Response()->json(['data' => $returnCategories, 'count' => $catCount]);
        } else {
            $catAllCount = Product::count();
            $categories = Category::orderBY('created_at', 'DESC')->paginate($catAllCount);
            return view('backend.category.list')->with('categories', $categories);
        }
    }

    //function creat - show create new category page
    public function create()
    {
        return view('backend.category.create');
    }

    //store category data with livewire in livewire/backend/category/create

    //function edit - show edit category page
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.update')->with('category', $category);
    }

    //update category data with livewire in livewire/backend/category/update


    //function destroy - delete category and it's all products
    public function destroy($id)
    {
        //delete category, category product's and it's images
        $category = Category::find($id);
        $category_products = Category::find($id)->products;
        foreach ($category_products as $prod) {
            $product_images = Product::find($prod->id)->product_images;
            foreach ($product_images as $img) {
                Storage::Delete('public/products/'.$img->image);
                $img->delete();
            }
            $prod->delete();
        }
        $category->delete();

        //logs stored when deleted by category observer in app\observers

        return Redirect::route('category.index');
    }

}
