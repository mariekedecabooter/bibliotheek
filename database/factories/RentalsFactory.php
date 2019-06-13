<?php

use App\Record;
use App\Rental;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rental::class, function (Faker $faker) {
    $records = Record::pluck('id')->toArray();
    $users = User::pluck('id')->toArray();

    return [
        //
        'record_id' => $faker->randomElement($records),
        'user_id' => $faker->unique()->randomElement($users),
        'date_in' => $faker->dateTime,
        'date_out' => $faker->dateTime,
        'date_returned' => NULL

    ];
});
