<?php

namespace App\Models\Communities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Users\User;
use App\Traits\ModelScopes;

class Community extends Model
{

    use SoftDeletes,ModelScopes;

    protected $fillable = [
        'num',
        'country',
        'title',
        'content',
        'hits',
        'commend',
        'user_id',
        'comment_count',
        'ip'
    ];

    
    protected $primaryKey = 'num'; //find() 를 사용하면 기본 키 열이 id 가 될 것이라고 자동으로 가정합니다. 모델에서 기본 키를 명시해야합니다.
    protected $dates = ['deleted_at'];
    
    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    
    public function comments(){
        return $this->hasMany('App\Models\Communities\Communities_Comment');
    }

    public function searchWriter($search){

        return
            User::select([
                'users.name',
                'communities.num',
                'communities.country',
                'communities.title',
                'communities.hits',
                'communities.commend',
                'communities.created_at',
                'communities.deleted_at'
                ])
            ->join('communities', 'communities.user_id', '=', 'users.id')
            ->whereNull('communities.deleted_at') 
            ->where('users.name', 'LIKE', "%$search%")
            ->latest('num')
            ->paginate(10)
            ->onEachSide(5);
    }


    public function searchWriterCount($search){

        return 
            count(User::join('communities', 'communities.user_id', '=', 'users.id')
            ->whereNull('communities.deleted_at')
            ->where('users.name', 'LIKE', "%$search%")
            ->get());
             
    }


}
