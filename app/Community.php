<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Community extends Model
{
    protected $fillable = [
        'num',
        'country',
        'title',
        'content',
        'hits',
        'commend',
        'user_id'
    ];

    protected $primaryKey = 'num'; //find() 를 사용하면 기본 키 열이 id 가 될 것이라고 자동으로 가정합니다. 모델에서 기본 키를 명시해야합니다.

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function insertMsg($country,$title,$content,$id){
        
        if($country == "한국"){
            $countryImg = asset("/data/ProjectImages/community/korea.png"); 
        }else if($country == "일본"){
            $countryImg =  asset("/data/ProjectImages/community/japan.png");
        }

        Community::create([
            'country' => $countryImg,
            'title' => $title,
            'content' => $content,
            'user_id' => $id
        ]);
    }

    public function getMsgs(){
        return $this::with('user:id,name')->orderBy('created_at','desc')->paginate(10)->onEachSide(5);
    }

    public function getMsg($id){
        return $this::with('user:id,name')->where('num',$id)->first();
    }

    public function updateMsg($id,$title,$content){
        $this::where('num',$id)->update(['title'=>$title,'content'=>$content]);
    }

    public function deleteMsg($id){
        $this::where('num',$id)->delete();
    }

    public function searchTitle($search){
        return $this::where('title','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
          
    }
    public function searchTitleCount($search){
        $result = $this::where('title','LIKE',"%$search%")->get();
        $result= count($result);
        return $result; 
     }

    public function searchWriter($search){
        return
            User::select(['users.name','communities.num','communities.country','communities.title', 'communities.content','communities.hits','communities.commend','communities.created_at',])
            ->join('communities', 'communities.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE', "%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
    }


    public function searchWriterCount($search){

        $result = User::select(['users.name','communities.num','communities.country','communities.title', 'communities.content','communities.hits','communities.commend','communities.created_at',])
            ->join('communities', 'communities.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE', "%$search%")->get();
        
            return count($result);
    }

    public function searchContent($search){
        return $this::where('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
    }

    public function searchContentCount($search){
        $result = $this->where('content','LIKE',"%$search%")->get();
        $result= count($result);
        
        return $result;     
    }

    public function searchTitleAndCotent($search){
        return $this->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10);
    }

    public function searchTitleAndCotentCount($search){
        $result = $this->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->get();
        $result= count($result);
        
        return $result; 
    
    }


}
