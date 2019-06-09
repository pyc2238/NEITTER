<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    
    protected $fillable = [
        'user_id',
        'friend_id',
        'is_friend',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

}
