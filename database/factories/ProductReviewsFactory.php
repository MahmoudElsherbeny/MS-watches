<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product_review;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product_review::class, function (Faker $faker) {
    return [
        'user' => function() {
            return User::all()->random();
        },
        'product' => function() {
            return Product::all()->random();
        },
        'review' => $faker->paragraph,
        'price' => $faker->numberBetween(1, 5),
    ];
});
