<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Address::class, function (Faker $faker) {
    $road_types = ['rue', 'allée', 'boulevard', 'avenue'];

    return [
        'number' => $faker->numberBetween($min = 1, $max = 200),
        'road_type' => $faker->randomElement($road_types),
        'road_name' => $faker->streetName,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
    ];
});
