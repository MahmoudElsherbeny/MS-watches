<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Product_image;
Use App\Product_review;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::flushEventListeners();
        factory(Product::class, 400)->create()->each(function ($product) {
            factory(Product_image::class, 4)->create();
            factory(Product_review::class, 8)->create();
        });
    }
}
