<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => 'GIAY DEP '.strval(rand(0,1000)),
        'size' => '35-40',
        'describe' => rtrim($faker->sentence(rand(5,10)),"."),
        'quantity' => rand(5,10)*100,
        'price_out' => 50000+rand(0,10)*5000,
    ];
});
