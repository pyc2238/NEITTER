<?php

namespace App\Models\Penpal;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
    protected $fillable = ['reason'];
    

    public function penpal()
    {
        return $this->hasOne('App\Models\Penpal\Penapl');
    }
}
