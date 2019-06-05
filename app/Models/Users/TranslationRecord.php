<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class TranslationRecord extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'korean',
        'japanese',
    ];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }


}
