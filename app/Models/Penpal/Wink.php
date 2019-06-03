<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Wink extends Model
{
    protected $fillable = [
        'user_id',
        'penpal_id',
    ];
}
