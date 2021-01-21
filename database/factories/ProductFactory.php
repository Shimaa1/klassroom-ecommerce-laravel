<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'category_id' => \App\Models\Category::all()->random()->id,    //Or Category::all()->random()
        'title' => $faker->name,
        'description' => $faker->realText(),
        'price' => random_int(100,1000),
        'sale_price' => random_int(0,1000),

    ];
});
