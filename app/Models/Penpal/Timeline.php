<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    
    protected $fillable = [
        'user_id',
        'content',
        'image',
        'is_system',
    ];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }


    public function getUser(){
        return $this->with(['user:id,name,gender,country,selfPhoto']);
    }
}
