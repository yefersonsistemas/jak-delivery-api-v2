<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    
    return [
        'type_dni' => 'J',
        'dni' => $faker->numberBetween(100000, 900000),
        'name' => $faker->firstName,
        'lastname'=> $faker->lastName,
        'phone' => $faker->numberBetween(04140000000, 04260000000),
        'email' => $faker->email,
    ];
});