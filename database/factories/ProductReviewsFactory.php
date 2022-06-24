<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product_review;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product_review::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::all()->random();
        },
        'product_id' => function() {
            return Product::all()->random();
        },
        'review' => $faker->paragraph,
        'rate' => $faker->numberBetween(1, 5),
    ];
});
