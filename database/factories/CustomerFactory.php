<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    $preferredPaymentMethods = ['cash', 'card'];
    
    return [
        'contact_information_id' => factory(App\ContactInformation::class)->create()->id,
        'user_id' => 1,
        'preferred_payment_method' => $preferredPaymentMethods[rand(0, 1)]
    ];
});