<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Category;

class CategoryCtrl extends Controller
{
    //function index - show categories page and categories live search
    public function index()
    {
        return view('backend.category.list');
    }

    //function creat - show create new category page
    public function create()
    {
        return view('backend.category.create');
    }

    //function edit - show edit category page
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.update')->with('category', $category);
    }

    //store, update and delete category data with livewire components in livewire/backend/category
}
