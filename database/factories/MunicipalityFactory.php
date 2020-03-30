<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Municipality;
use Faker\Generator as Faker;

$factory->define(Municipality::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
    ];
});
