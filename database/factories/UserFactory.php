<?php

use App\Address;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $addresses = Address::pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),

        'role_id'=> $faker->numberBetween(1,2),
        'address_id'=> $faker->unique()->numberBetween($min=2, $max=10),
        'is_active'=>1,
        'last_name'=> $faker->lastName,
        'rijksregisternummer' => \Faker\Provider\nl_BE\Person::rrn()
    ];
});
