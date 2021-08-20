<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Product_image;
use App\Product_review;
use App\Category;
use App\Admin;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'category' => function() {
            return Category::all()->random();
        },
        'mini_description' => $faker->paragraph,
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween(100, 2000),
        'sale' => 0,
        'body_color' => 'silver',
        'mina_color' => 'white',
        'status' => 'active',
        'published_by' => function() {
            return Admin::all()->random();
        },
    ];
});



$factory->define(product_image::class, function (Faker $faker) {
    return [
        'product' => function() {
            return Product::all()->random();
        },
        'image' => '1.png',
        'order' => $faker->numberBetween(1, 4),
    ];
});



$factory->define(Product_review::class, function (Faker $faker) {
    return [
        'user' => function() {
            return User::all()->random();
        },
        'product' => function() {
            return Product::all()->random();
        },
        'review' => $faker->paragraph,
        'rate' => $faker->numberBetween(1, 5),
    ];
});
