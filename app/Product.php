<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category', 'mini_description', 'description', 'price', 'old_price', 'body_color', 'mina_color', 'rate', 'tags', 'status', 'published_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function published_by()
    {
        return $this->belongsTo(Admin::class, 'published_by', 'id');
    }

    public function product_images()
    {
        return $this->hasMany(Product_image::class, 'product', 'id');
    }

    public function product_reviews()
    {
        return $this->hasMany(Product_review::class, 'product', 'id');
    }
    

    //products filters
    public function scopeWithFilters($query,$filters) {
        return $query
                ->when(array_filter($filters['categories']), function ($query) use ($filters) {
                    $query->WhereIn('category', $filters['categories']);
                })
                ->when($filters['sort'], function ($query) use ($filters) {
                    if($filters['sort'] == 'price') {
                        $query->OrderBy('price','ASC');
                    }
                    else {
                        $query->OrderBy($filters['sort'],'Desc');
                    }
                })
                ->when($filters['tags'], function ($query) use ($filters) {
                    $query->Where('tags', $filters['tags']);
                })
                ->when($filters['prices'], function ($query) use ($filters) {
                    $priceFilter = explode(',', $filters['prices']);
                    $query->WhereBetween('price', [$priceFilter]);
                });
    }

    //get products 
    static public function getSaleProducts($condition,$orderby,$limit) {
        $products = Self::Where('status','active')
                    ->Where('old_price',$condition,0)
                    ->OrderBy($orderby,'DESC')->limit($limit)->get();   
        return $products;
    }

}
