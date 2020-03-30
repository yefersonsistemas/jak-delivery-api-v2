<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'type_dni' => $faker->randomElement(['V', 'E']),
        'dni' => $faker->numberBetween(10000000, 30000000),
        'name' => $faker->firstName,
        'lastname'=> $faker->lastName,
        'phone' => $faker->numberBetween(04140000000, 04260000000),
        'email' => $faker->email,
    ];
});