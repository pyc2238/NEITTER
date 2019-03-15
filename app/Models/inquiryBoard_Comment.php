<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelScopes;

class inquiryBoard_Comment extends Model
{
    use SoftDeletes;
    use ModelScopes;

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
        return $this->belongsTo(User::class);
    }

    public function inquery_boards(){
        return $this->belongsTo(inquiryBoard::class);
    }
}
