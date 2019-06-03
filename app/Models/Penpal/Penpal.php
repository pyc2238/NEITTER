<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Penpal extends Model
{
    protected $fillable = [
        'user_id',
        'self_context',
        'image',
        'language',
        'goal_id',
        'created_at'
    ];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function goal()
    {
        return $this->hasOne('App\Models\Penpal\Penapl','goal_id');
    }

     //penpals테이블 user테이블 N-N (중간테이블 penpal_user)
     public function penpal_user(){
        return $this->belongsToMany('App\Models\Users\User','penpal_user');
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


    public function updateFile($file){
        $this->where('id',Auth::user()->id)
            ->update(['image' => $file]);
    }

    public function getUser(){
        return $this->with(['user:id,name,gender,country,age,selfPhoto']);
    }

   



}
