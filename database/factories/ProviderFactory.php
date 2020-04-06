<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use Faker\Generator as Faker;
use App\Typepayment;

$factory->define(Provider::class, function (Faker $faker) {
      $typepayment = Typepayment::inRandomOrder()->first();
    return [
        'person_id' => $faker->firstName,
        'price_delivery'=> $faker->lastName,
        'typepayment' => $typepayment->id,
    ];
});