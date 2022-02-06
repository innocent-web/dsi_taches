<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tache;
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

$factory->define(Tache::class, function (Faker $faker) {
    return [
        'nom' => $faker->sentence(3),
        'description' => $faker->sentence(10),
        'done' => $faker->numberBetween(0,1),
    ];
});
