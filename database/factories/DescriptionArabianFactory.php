<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Arabian;
use Faker\Generator as Faker;
use App\Provider;
use App\Food_Arabian;

$factory->define(Description_Arabian::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $arabian = Food_Arabian::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'arabian_id' => $arabian->id,
    ];
});
