<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Person;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    return [
        'person_id' => $person->id,
    ];
});