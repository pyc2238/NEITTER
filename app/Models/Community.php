<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Traits\ModelScopes;

class Community extends Model
{

    use SoftDeletes;
    use ModelScopes;

    protected $fillable = [
        'num',
        'country',
        'title',
        'content',
        'hits',
        'commend',
        'user_id',
        'ip'
    ];

    protected $primaryKey = 'num'; //find() 를 사용하면 기본 키 열이 id 가 될 것이라고 자동으로 가정합니다. 모델에서 기본 키를 명시해야합니다.
    protected $dates = ['deleted_at'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    
    public function comments(){
        return $this->hasMany(Communities_Comment::class);
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
            ->orderBy('num', 'desc')
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
