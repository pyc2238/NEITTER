<?php

use Faker\Generator as Faker;

$factory->define(App\Admin_Notice::class, function (Faker $faker) {
    $minId = App\User::min('id');
    $maxId = App\User::max('id');
    $country = $faker->randomElement(['한국', '일본']);
    

    if($country == "한국"){
        $countryImg = asset("/data/ProjectImages/community/korea.png"); 
    }else if($country == "일본"){
        $countryImg =  asset("/data/ProjectImages/community/japan.png");
    }


    return [
        'title' =>$faker->word(10),
        'content' => $faker->sentence,
        'country' => $countryImg,
        'user_id' => $faker->numberBetween($minId,$maxId)
    ];
});
