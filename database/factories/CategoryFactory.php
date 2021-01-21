<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        //'name' => $faker->colorName,
        'name' => $faker->realText(random_int(10,15)),
        'banner' => $faker->imageUrl(),
    ];
});
