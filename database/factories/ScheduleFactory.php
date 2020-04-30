<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'turn' => $faker->randomElement(['Mañana', 'Tarde', 'Noche']),
    ];
});
