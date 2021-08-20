<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        [
            'name' => 'name',
            'value' => 'ms',
        ],
        [
            'name' => 'address',
            'value' => 'portfouad, portsaid egypt',
        ],
        [
            'name' => 'phone',
            'value' => '01287542932',
        ],
        [
            'name' => 'email',
            'value' => 'mswatches12@gmail.com',
        ],
        [
            'name' => 'facebook',
            'value' => 'https://www.facebook.com',
        ],
        [
            'name' => 'twitter',
            'value' => 'https://www.twitter.com',
        ],
        [
            'name' => 'instagram',
            'value' => 'https://www.instagram.com',
        ]
    ];
});
