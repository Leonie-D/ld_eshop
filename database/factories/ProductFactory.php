<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Color;
use App\Category;
use App\Tax;
use App\Deal;

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

$factory->define(Product::class, function (Faker $faker) {
    $colors = App\Color::pluck('id')->toArray(); // récupère tous les id de la table colors
    $categories = App\Category::pluck('id')->toArray(); // récupère tous les id de la table categories

    return [
        'name' => $faker->word,
        'description' => $faker->sentences($nb = 3, $asText = true),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100),
        'category_id' => $faker->randomElement($categories),
    ];
});
