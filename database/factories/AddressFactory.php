<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;
use App\State;
use App\Municipality;
use App\City;
use App\Parishe;

$factory->define(Address::class, function (Faker $faker) {
        $state = State::inRandomOrder()->first();
        $municipality = Municipality::inRandomOrder()->first();
        $city = City::inRandomOrder()->first();
        $parishe = Parishe::inRandomOrder()->first();
    return [
        'states_id' => $state->id,
        'cities_id'=>$city->id,
        'municipalities_id' =>$municipality->id,
        'parishes_id' => $parishe->id,
        'address' => $faker->address,
    ];
});
