<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path'           => null,
        'imageable_id'   => null,
        'imageable_type' => null,
    ];
});
