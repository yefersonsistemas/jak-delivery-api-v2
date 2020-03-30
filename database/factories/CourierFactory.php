<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Courier;
use App\Person;
use App\Address;
use Faker\Generator as Faker;

$factory->define(Courier::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $address = Address::inRandomOrder()->first();
    return [
        'person_id' => $person->id,
        'address_id' => $address->id,
        'type_vehicle' => $faker->randomElement(['Moto', 'Automóvil']),
        // 'business_delivery' => $faker->numberBetween(1, 3),
        'business_delivery' => $faker->randomNumber, //contiene el id de la persona o empresa que proporciona el repartidor
    ];
});