<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_stores', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('admin_id');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_stores');
    }
}
