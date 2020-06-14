<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Color_product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Product;
use App\Color;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Color_product::class, function (Faker $faker) {
    $products = App\Product::pluck('id')->toArray(); // récupère tous les id de la table products
    $colors = App\Color::pluck('id')->toArray(); // récupère tous les id de la table colors

    return [
        'product_id' => $faker->randomElement($products),
        'color_id' => $faker->randomElement($colors),
        'stock' => $faker->numberBetween($min = 0, $max = 50),
    ];
});
