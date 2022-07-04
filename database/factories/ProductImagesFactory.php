<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Product_image;
use Faker\Generator as Faker;

$factory->define(Product_image::class, function (Faker $faker) {
    return [
        'product_id' => function() {
            return factory(App\Product::class)->create()->id;
        },
        'image' => 'products/product_image.png',
        'order' => $faker->numberBetween(1, 4),
    ];
});
