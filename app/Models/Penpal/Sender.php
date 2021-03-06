<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'image',
        'recipient_name',
        'country',
        'is_friend',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

}
