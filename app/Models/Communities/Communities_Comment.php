<?php

namespace App\Models\Communities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelScopes;
class Communities_Comment extends Model
{
    use SoftDeletes,ModelScopes;

    protected $fillable = [
        'id',
        'content',
        'country',
        'board_id',
        'user_id',
        'ip'
    ];

    
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function communities(){
        return $this->belongsTo('App\Models\Communities\Community');
    }

}
