<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address_user;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Address;
use App\User;

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

$factory->define(Address_user::class, function (Faker $faker) {
    $addresses = App\Address::pluck('id')->toArray(); // récupère tous les id de la table addresses
    $users = App\User::pluck('id')->toArray(); // récupère tous les id de la table users

    return [
        'address_id' => $faker->randomElement($adresses),
        'user_id' => $faker->randomElement($users),
        'name' => $faker->word->optional(),
    ];
});
