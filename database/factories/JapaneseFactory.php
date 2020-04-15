<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Food_Japanese;
use Faker\Generator as Faker;
use App\Provider;

$factory->define(Food_Japanese::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'price_bs'=>$faker->randomNumber,
        'price_us' =>$faker->randomDigit,
        'type' => $faker->sentence(4),
        'providers_id' => $provider->id,
    ];
});
