<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'penpal_point',
        'community_point',
        'timeline_point',
        'letter_point',
        'login_point',
    ];

    public function user(){
        return $this->hasOne('App\Models\Users\User');
    }
}
