<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'legal_number' => $faker->randomNumber(8),
        'tax_number' => $faker->vat,
        'contact_information_id' => factory(App\ContactInformation::class)->create()->id
    ];
});
