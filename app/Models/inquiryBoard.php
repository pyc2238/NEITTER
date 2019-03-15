<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Traits\ModelScopes;

class inquiryBoard extends Model
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
        return $this->hasMany(inquiryBoard_Comment::class);
    }


    public function searchWriter($search){
        return
            User::select([
                'users.name',
                'inquiry_boards.num',
                'inquiry_boards.country',
                'inquiry_boards.title',
                'inquiry_boards.hits',
                'inquiry_boards.commend',
                'inquiry_boards.created_at',
                'inquiry_boards.deleted_at'
                ])
            ->join('inquiry_boards', 'inquiry_boards.user_id', '=', 'users.id')
            ->whereNull('inquiry_boards.deleted_at') 
            ->where('users.name', 'LIKE', "%$search%")
            ->orderBy('num', 'desc')
            ->paginate(10)
            ->onEachSide(5);
    }


    public function searchWriterCount($search){

        return 
            count(User::join('inquiry_boards', 'inquiry_boards.user_id', '=', 'users.id')
            ->whereNull('inquiry_boards.deleted_at')
            ->where('users.name', 'LIKE', "%$search%")
            ->get());
             
    }

    


}
