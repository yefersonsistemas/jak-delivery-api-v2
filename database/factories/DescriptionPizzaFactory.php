<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Pizza;
use Faker\Generator as Faker;
use App\Provider;
use App\Food_Pizza;

$factory->define(Description_Pizza::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $pizza =Food_Pizza::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'pizza_id' => $pizza->id,
    ];
});
