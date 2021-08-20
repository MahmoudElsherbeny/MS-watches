<?php

namespace App\Observers;

use App\Category;
use App\Dashboard_log;
use Auth;

class CategoryObserver
{

    protected $except = [
        'created_at',
        'updated_at'
    ];

    /**   Handle the category "created" event.   **/
    public function created(Category $category)
    {
        //store logs when category created
        if ($category->wasRecentlyCreated == true) {
            Dashboard_log::create([
                'user' => Auth::guard('admin')->user()->id,
                'log' => 'create new category '.$category->name,
            ]);
        }
    }

    /**   Handle the category "updated" event.   **/
    public function updated(Category $category)
    {
        // search for changes
        foreach ($category->getChanges() as $attribute => $new_value) {

            $category_name = $category->getOriginal('name');
            if ($attribute != 'updated_at') {
                Dashboard_log::create([
                    'user' => Auth::guard('admin')->user()->id,
                    'log' => 'Update category '.$category_name.' '.$attribute.' to '.$new_value,
                ]);
            }
        }
    }

    /**   Handle the category "deleted" event.   **/
    public function deleted(Category $category)
    {
        //store logs when category deleted
        Dashboard_log::create([
            'user' => Auth::guard('admin')->user()->id,
            'log' => 'Delete category '.$category->name,
        ]);
    }

    /**   Handle the category "restored" event.   **/
    public function restored(Category $category)
    {
        //
    }

    /**   Handle the category "force deleted" event.   **/
    public function forceDeleted(Category $category)
    {
        //
    }
}
