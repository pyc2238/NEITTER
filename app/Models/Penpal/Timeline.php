<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    
    protected $fillable = [
        'user_id',
        'content',
        'image',
    ];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

}
