<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin_Notice_hit extends Model
{
    protected $fillable = ['id','userNum','boardNum'];
    public $timestamps = false;

    public function getHitsId($userNum,$boardNum){
      
        return $this->where('userNum',$userNum)->where(function ($query) use($boardNum) { $query->where('boardNum',$boardNum);})->first();
    }

    public function insertHitId($userNum,$boardNum){
        $this->create([
            'userNum' => $userNum,
            'boardNum' =>$boardNum
        ]);
    }
}
