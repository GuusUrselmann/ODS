<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ContactInformation::class, function (Faker $faker) {
    return [
        'address' => $faker->streetName,
        'house_number' => $faker->numberBetween(1, 1000),
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber
    ];
});
