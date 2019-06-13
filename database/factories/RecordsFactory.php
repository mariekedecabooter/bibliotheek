<?php

use App\Author;
use App\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    $authors = Author::pluck('id')->toArray();
    return [
        //
        'titel' => $faker->sentence,
        'auteur_id' => $faker->randomElement($authors),
        'isbn' => $faker->isbn10,
        'jaartal' => $faker->year,
        'uitgave' => $faker->numberBetween(1,5),
        'beschrijving' =>$faker->text($maxNbChars = 400),
        'aantal' => $faker->numberBetween(1,15),
        'photo_id' => NULL
    ];
});
