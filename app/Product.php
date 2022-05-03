<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'category', 'mini_description', 'description', 'price', 'sale', 'body_color', 'mina_color', 'tags', 'status', 'published_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function published_by()
    {
        return $this->belongsTo(Admin::class, 'published_by', 'id');
    }
    

    //products filters
    public function scopeWithFilters($query,$filters) {
        return $query->when(array_filter($filters['categories']), function ($query) use ($filters) {
                    $query->WhereIn('category', $filters['categories'])->OrderBy('id','Desc');
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
                    $query->Where('tags', $filters['tags'])->OrderBy('id','Desc');;
                })
                ->when($filters['prices'], function ($query) use ($filters) {
                    $priceFilter = explode(',', $filters['prices']);
                    $query->WhereBetween('price', [$priceFilter])
                          ->orWhereBetween('sale', [$priceFilter])
                          ->OrderBy('id','Desc');
                });
    }

    //get products 
    static public function getSaleProducts($condition,$orderby,$limit) {
        $products = Self::Where('status','active')
                    ->Where('sale',$condition,0)
                    ->OrderBy($orderby,'DESC')->limit($limit)->get();   
        return $products;
    }

}
