<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\ImageProduct::class, function (Faker $faker) {
    return [
        'url_img' => "https://cdn2.iconfinder.com/data/icons/fitness-43/64/Fitness-87-512.png",
        'is_main_img' => '0'
    ];
});
