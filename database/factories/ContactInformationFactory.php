<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ContactInformation::class, function (Faker $faker) {
    return [
        'street_name' => $faker->streetName,
        'house_number' => $faker->numberBetween(1, 1000),
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'phone' => $faker->phoneNumber
    ];
});
