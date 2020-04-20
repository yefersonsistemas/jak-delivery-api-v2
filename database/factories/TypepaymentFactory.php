<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypePayment;
use Faker\Generator as Faker;

$factory->define(TypePayment::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
