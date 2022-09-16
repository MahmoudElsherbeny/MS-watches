<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('category_id');
            $table->text('mini_description');
            $table->text('description');
            $table->integer('price');
            $table->integer('old_price');
            $table->text('attributes');
            $table->float('rate');
            $table->string('tags');
            $table->string('status');
            $table->integer('admin_id');
            $table->integer('all_quantity');
            $table->integer('quantity');
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
        Schema::dropIfExists('products');
    }
}
