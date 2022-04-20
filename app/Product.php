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
        return $query->when(count(array_filter($filters['categories'])), function ($query) use ($filters) {
                    $query->WhereIn('category', [$filters['categories']]);
                })
                ->when($filters['sort'], function ($query) use ($filters) {
                    $query->OrderBy($filters['sort'],'Desc');
                })
                ->when($filters['tags'], function ($query) use ($filters) {
                    $query->Where('tags', $filters['tags']);
                })
                ->when($filters['prices'], function ($query) use ($filters) {
                    $query->WhereBetween('price', [explode(',', $filters['prices'])[0],explode(',', $filters['prices'])[1]])
                          ->orWhereBetween('sale', [explode(',', $filters['prices'])[0],explode(',', $filters['prices'])[1]]);
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
