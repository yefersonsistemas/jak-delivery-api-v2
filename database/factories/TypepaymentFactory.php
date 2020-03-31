<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Typepayment;
use Faker\Generator as Faker;

$factory->define(Typepayment::class, function (Faker $faker) {
    return [
        'name'=> $faker->randomElement(['Efectivo', 'Pago Móvil', 'Transferencia']),
    ];
});