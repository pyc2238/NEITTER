<?php

use Illuminate\Database\Seeder;
use App\Models\Penpal\Goal;
class CreateGoalTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reason = array(
        
            array('reason' => '이메일 친구 찾아요'),
            array('reason' => '이성 친구 찾아요'),
            array('reason' => '한국어/일본어 배우고 싶어요'),
            array('reason' => '여행가이드 찾아요'),
            array('reason' => '한국/일본을 알고싶어요'),
            array('reason' => '기타'),
        
        );
        
        foreach($reason as $rs){ 
            Goal::insert($rs);
         } 
    }
}
