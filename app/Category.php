<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon','order','status'];

    //get category name
    static public function getCategoryName($id) {
        $category = Self::find($id);
        if($category) {
            return $category->name;
        }
        else {
            return 'Not Found';
        }
    }
}
