<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Communities_Comment::class, function (Faker $faker) {
        $minId = App\Models\User::min('id');
        $maxId = App\Models\User::max('id');
        $communityminId = App\Models\Community::min('num');
        $communitymaxId = App\Models\Community::max('num');
        $country = $faker->randomElement(['한국', '일본']);
        $ip = '192.58.44';

        if($country == "한국"){
            $countryImg = asset("/data/ProjectImages/community/korea.png"); 
        }else if($country == "일본"){
            $countryImg =  asset("/data/ProjectImages/community/japan.png");
        }


        return [

            'content' => $faker->sentence,
            'board_id' => $faker->numberBetween($communityminId,$communitymaxId),
            'user_id' => $faker->numberBetween($minId,$maxId),
            'country' => $countryImg,
            'ip' => $ip,
    ];
});
