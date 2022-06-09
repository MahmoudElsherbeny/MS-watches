<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    protected $fillable = ['product_id', 'image','order'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    //check from image name if it image
    static public function isImage($image) {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz'];

        $explode = explode('.', $image);
        $explodeExtension = end($explode);

        if(in_array($explodeExtension, $imageExtensions)) {
            return true;
        }
        return false;
    }

    //check from image name if it video
    static public function isVideo($video) {
        $videoExtensions = ['mp4', 'mkv', 'webm', 'ogg'];

        $explode = explode('.', $video);
        $explodeExtension = end($explode);

        if(in_array($explodeExtension, $videoExtensions)) {
            return true;
        }
        return false;
    }

    //get product main image
    static public function ProductMainImage($id) {
        $image = Self::Where('product_id',$id)->orderBy('order')->first();
        if($image) {
            return asset('sorage/'.$image->image);
        }
        else {
            return 'frontend/images/product/1.png';
        }
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

}
