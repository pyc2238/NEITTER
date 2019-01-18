<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Traits\ModelScopes;

class Admin_Notice extends Model
{
    use SoftDeletes;
    use ModelScopes;

    protected $fillable = [
        'num',
        'country',
        'title',
        'content',
        'hits',
        'user_id',
        'ip',
        
    ];

    protected $primaryKey = 'num'; //find() 를 사용하면 기본 키 열이 id 가 될 것이라고 자동으로 가정합니다. 모델에서 기본 키를 명시해야합니다.
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function searchWriter($search){
        return
            User::select([
                'users.name',
                'admin__notices.num',
                'admin__notices.country',
                'admin__notices.title',
                'admin__notices.hits',
                'admin__notices.created_at',
                'admin__notices.deleted_at'
            ])
            ->join('admin__notices', 'admin__notices.user_id', '=', 'users.id')
            ->whereNull('admin__notices.deleted_at') 
            ->where('users.name', 'LIKE', "%$search%")
            ->orderBy('num', 'desc')
            ->paginate(10)
            ->onEachSide(5);
    }


    public function searchWriterCount($search){

        return 
            count(User::join('communities', 'communities.user_id', '=', 'users.id')
            ->whereNull('admin__notices.deleted_at')
            ->where('users.name', 'LIKE', "%$search%")
            ->get()); 
    }

}
