<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'product_id' => function() {
            return Product::all()->random();
        },
        'image' => 'products/product_image.png',
        'order' => $faker->numberBetween(1, 4),
    ];
});
