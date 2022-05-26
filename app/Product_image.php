<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    protected $fillable = ['product', 'image','order'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }

    /*
    //get product images
    static public function getProductImages($id) {
        $images = Self::Where('product',$id)->first();
        if($images) {
            return 'storage/products/'.$images->image;
        }
        else {
            return 'frontend/images/product/1.png';
        }
    }
    */

    //get product main image
    static public function ProductMainImage($id) {
        $image = Self::Where('product',$id)->orderBy('order')->first();
        if($image) {
            return 'storage/products/'.$image->image;
        }
        else {
            return 'frontend/images/product/1.png';
        }
    }

}
