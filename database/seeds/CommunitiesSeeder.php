<?php

use Illuminate\Database\Seeder;
use App\Community;
class CommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new Community();
        for($i = 0; $i<20; $i++)
        {    $test->country = '일본';
            $test->title = '라라벨';
            $test->writer = '보근';
            $test->content = '텍스트';
            $test->user_id = 13;
            $test->save();
        }
    }
}
