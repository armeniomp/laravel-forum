<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name
    ];
});

$factory->state(App\Category::class, 'subcategory', function (Faker $faker) {
    $name = $faker->word;
    $category = App\Category::all()->random();

    return [
        'parent_id' => $category->id,
        'name' => $name,
        'slug' => $name
    ];
});