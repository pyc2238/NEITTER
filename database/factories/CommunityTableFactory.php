<?php

use Faker\Generator as Faker;

$factory->define(App\Community::class, function (Faker $faker) {
    $minId = App\User::min('id');
    $maxId = App\User::max('id');
    // $country = $faker->randomElement(['한국', '일본']);
    $ip = '192.58.44';
    return [
        'title' =>$faker->word(10),
        'content' => $faker->sentence,
        'country' => $country,
        'ip' => $ip,
        'user_id' => $faker->numberBetween($minId,$maxId)
    ];
});


