<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Transmit extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'image',
        'recipient_name',
        'is_read',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }
}
