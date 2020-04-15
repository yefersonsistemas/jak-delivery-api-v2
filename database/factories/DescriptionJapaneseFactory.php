<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Japanese;
use Faker\Generator as Faker;
use App\Provider;
use App\Food_Japanese;

$factory->define(Description_Japanese::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $japanese =Food_Japanese::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'japanese_id' => $japanese->id,
    ];
});
