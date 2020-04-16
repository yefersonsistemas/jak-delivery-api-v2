<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Chicken;
use Faker\Generator as Faker;
use App\Food_Chicken;
use App\Provider;

$factory->define(Description_Chicken::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $chicken = Food_Chicken::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'chicken_id' => $chicken->id,
    ];
});
