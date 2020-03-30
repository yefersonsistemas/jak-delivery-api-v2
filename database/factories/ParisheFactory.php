<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Parishe;
use Faker\Generator as Faker;

$factory->define(Parishe::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
    ];
});