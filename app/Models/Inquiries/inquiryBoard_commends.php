<?php

namespace App\Models\Inquiries;

use Illuminate\Database\Eloquent\Model;

class inquiryBoard_commends extends Model
{
    protected $fillable = ['id','userNum','boardNum'];
    public $timestamps = false;

     //아이디와 게시판 넘버가 함꼐 있는 레코드를 찾는다. 
     public function getCommendId($userNum,$boardNum){
        return $result = $this->where('userNum',$userNum)->where('boardNum',$boardNum)->first();
        
    }

    public function insertCommendId($userNum,$boardNum){
        $result = $this->create(['userNum'=>$userNum,'boardNum'=>$boardNum]);
    }
}
