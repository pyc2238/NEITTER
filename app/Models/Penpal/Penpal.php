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
