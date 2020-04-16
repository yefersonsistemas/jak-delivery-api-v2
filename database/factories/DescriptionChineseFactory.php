<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Description_Chinese;
use Faker\Generator as Faker;
use App\Provider;
use App\Food_Chinese;

$factory->define(Description_Chinese::class, function (Faker $faker) {
    $provider = Provider::inRandomOrder()->first();
    $chinese = Food_chinese::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(6),
        'providers_id' => $provider->id,
        'chinese_id' => $chinese->id,
    ];
});
