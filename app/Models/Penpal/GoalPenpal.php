<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class GoalPenpal extends Model
{
    public $timestamps = false;
    protected $fillable = ['penpal_id','goal_id'];
    protected $table = 'goal_penpal';
}
