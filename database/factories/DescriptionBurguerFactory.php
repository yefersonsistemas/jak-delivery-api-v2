<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Burguer;
use Faker\Generator as Faker;
use App\Food_Burguer;
use App\Provider;

$factory->define(Description_Burguer::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $burguer = Food_Burguer::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'burguer_id' => $burguer->id,
    ];
});
