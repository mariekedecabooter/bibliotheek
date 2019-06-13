<?php

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

    return [
        //
        'straat' => \Faker\Provider\nl_BE\Address::streetSuffix(),
        'nummer' => \Faker\Provider\nl_BE\Address::buildingNumber(),
        'busnummer' => $faker->numberBetween(0,10),
        'postcode' => \Faker\Provider\nl_BE\Address::postcode(),
        'stad' => $faker->city
    ];
});
