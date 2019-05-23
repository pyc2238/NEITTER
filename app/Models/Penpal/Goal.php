<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
    protected $fillable = ['reason'];
    
    //penpals테이블 goals테이블 N-N (중간테이블 goal_penpal)
    public function penpal(){
        return $this->belongsToMany('App\Models\Penpal\Penpal','goal_penpal');
    }
}
