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
        return $this::with('user:id,name')->orderBy('created_at','desc')->paginate(10);
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
}
