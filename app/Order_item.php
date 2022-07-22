<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    //check if there orders created after product new quantity added 
    static public function isOrdersAfterQtyAdd($prod_id, $new_qty_date) {
        $order_products = Self::Where('created_at', '>', $new_qty_date)
                            ->Where('product_id', $prod_id)
                            ->get();

        return count($order_products);
        //return $order_products ? true :false;
    }

}
