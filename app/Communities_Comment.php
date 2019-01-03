<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Communities_Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'content',
        'country',
        'board_id',
        'user_id',
    ];

    
    protected $dates = ['deleted_at'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function communities(){
        return $this->belongsTo(Community::class);
    }


    public function insertComment($content,$country,$board_id,$user_id){
        if($country == "한국"){
            $countryImg = asset("/data/ProjectImages/community/korea2.png"); 
        }else if($country == "일본"){
            $countryImg =  asset("/data/ProjectImages/community/japan2.png");
        }

        $param = [
            'content' => $content,
            'country' => $countryImg,
            'board_id' => $board_id,
            'user_id' => $user_id
        ];

        $this::create($param);
    }

    public function getComments($id){
        return $this::with('user:id,name')->where('board_id',$id)->paginate(15);
    }

    public function updateComments($id,$content){
        $this::where('id',$id)->update(['content'=>$content]);
    }

    public function deleteComments($id){
        $this::where('id',$id)->delete();
    }
}
