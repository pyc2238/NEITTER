<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Users\User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['남자', '여자']);
    $address = $faker->randomElement(['seoul', 'fucuoka','tokyo','wonju','kyoto','busan','osaka']);
    $country = $faker->randomElement(['한국', '일본']);
    $age = rand(3,100);
    
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret,
        'gender' => $gender,
        'age' => $age,
        'address' => $faker->address,
        'country' => $country,
        'remember_token' => str_random(10),
    ];
});

