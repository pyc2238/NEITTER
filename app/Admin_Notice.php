<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Admin_Notice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'num',
        'country',
        'title',
        'content',
        'hits',
        'user_id',
    ];

    protected $primaryKey = 'num'; //find() 를 사용하면 기본 키 열이 id 가 될 것이라고 자동으로 가정합니다. 모델에서 기본 키를 명시해야합니다.
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function insertMsg($country,$title,$content,$id){
        
        if($country == "한국"){
            $countryImg = asset("/data/ProjectImages/community/korea.png"); 
        }else if($country == "일본"){
            $countryImg =  asset("/data/ProjectImages/community/japan.png");
        }

        $this::create([
            'country' => $countryImg,
            'title' => $title,
            'content' => $content,
            'user_id' => $id,
            
        ]);
    }



    public function getMsgs(){
        return $this::with('user:id,name')->orderBy('created_at','desc')->paginate(10)->onEachSide(5);
    }

    public function getMsg($id){
        return $this::with('user:id,name')->where('num',$id)->first();
    }
    
    public function updateMsg($id,$title,$content){
        $param = [
            'title'=>$title,
            'content'=>$content,
        ];

        $this::where('num',$id)->update($param);
    }

    public function deleteMsg($id){
        $this::where('num',$id)->delete();
    }


    public function searchTitle($search){
        return $this::where('title','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
          
    }
    public function searchTitleCount($search){
        return count($this::where('title','LIKE',"%$search%")->get());
        
     }

    public function searchWriter($search){
        return
            User::select(['users.name','admin__notices.num','admin__notices.country','admin__notices.title','admin__notices.hits','admin__notices.created_at',])
            ->join('admin__notices', 'admin__notices.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE', "%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
    }


    public function searchWriterCount($search){

        return count(User::join('communities', 'communities.user_id', '=', 'users.id')->where('users.name', 'LIKE', "%$search%")->get());
             
    }

    public function searchContent($search){
        return $this::where('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
    }

    public function searchContentCount($search){
        return count($this->where('content','LIKE',"%$search%")->get());     
    }

    public function searchTitleAndCotent($search){
        return $this->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10);
    }

    public function searchTitleAndCotentCount($search){
        return count( $this->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->get());
    }

    public function updateHits($id){
        $result = $this::where('num',$id)->first();
        $result->hits++;
        $result->save();
    }
}
