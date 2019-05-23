<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Penpal extends Model
{
    protected $fillable = [
        'user_id',
        'self_context',
        'image',
        'language',
    ];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    //penpals테이블 goals테이블 N-N (중간테이블 goal_penpal)
    public function goal(){
        return $this->belongsToMany('App\Models\Penpal\Goal','goal_penpal');
    }


    //사용가능 언어  저장시 json속성 포맷 변환
    public function setLanguageAttribute($value) {
        $this->attributes['language'] = json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    //사용가능 언어  추출시 배열 속성 포맷 변환
    public function getLanguageAttribute($value)
    {
        return json_decode($value,true);
    }

}
