<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function(Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'icon' => 'ion-android-watch',
        'order' => $faker->numberBetween(1,15),
        'status' => 'active',
    ];
});
