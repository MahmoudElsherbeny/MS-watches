<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category_id', 'mini_description', 'description', 'price', 'old_price', 'body_color', 'mina_color', 'rate', 'tags', 'status', 'admin_id', 'all_quantity', 'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function published_by()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function product_images()
    {
        return $this->hasMany(Product_image::class)->OrderBy('order');
    }

    public function product_reviews()
    {
        return $this->hasMany(Product_review::class);
    }

    public function products_stores()
    {
        return $this->hasMany(Products_store::class)->OrderBy('updated_at','Desc');
    }
    
    public function product_orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
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
                    elseif($filters['sort'] == 'name') {
                        $query->OrderBy('name','ASC');
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
