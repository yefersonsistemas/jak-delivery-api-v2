<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Drink;
use Faker\Generator as Faker;
use App\Drink;
use App\Provider;

$factory->define(Description_Drink::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $drink = Drink::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'drinks_id' => $drink->id,
    ];
});
