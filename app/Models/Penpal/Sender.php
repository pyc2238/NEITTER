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
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

}
