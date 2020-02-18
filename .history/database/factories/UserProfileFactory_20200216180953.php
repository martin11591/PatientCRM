<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'names' => $faker->firstName,
        'surnames' => $faker->lastName,
        'doc_id' => $faker->personalIdentityNumber,
        'birth_date' => $faker->dateTime,
        'birth_zip_code' => $faker->postcode,
        'birth_city' => $faker->city,
        'birth_country' => $faker->country,
        'registered_zip_code' => $faker->postcode,
        'registered_city' => $faker->city,
        'registered_country' => $faker->country,
        'correspondence_zip_code' => $faker->postcode,
        'correspondence_city' => $faker->city,
        'correspondence_country' => $faker->country,
    ];
});
