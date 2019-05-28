<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class PenpalUser extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','penpal_id'];
    protected $table = 'penpal_user';
}
