<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Mexican;
use Faker\Generator as Faker;
use App\Provider;
use App\Food_Mexican;

$factory->define(Description_Mexican::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $mexican =Food_Mexican::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'mexican_id' => $mexican->id,
    ];
});
