<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Security;
use App\Person;
use Faker\Generator as Faker;

$factory->define(Security::class, function (Faker $faker) {
      $person = Person::inRandomOrder()->first();
    return [
        'person_id' => $person->id,
        // 'question'=> $faker->word,
        // 'answers' =>  $faker->word,
        'question_1'=> $faker->word,
        'answers_1' =>  $faker->word,
        'question_2'=> $faker->word,
        'answers_2' =>  $faker->word,
        'question_3'=> $faker->word,
        'answers_3' =>  $faker->word,
    ];
});
