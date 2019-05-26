<?php

namespace App\Traits;

trait ModelScopes{
    
    public function scopeInsertMsg($query,$country,$title,$content,$id,$ip){
        
        $query->create([
            'country' => $country,
            'title' => $title,
            'content' => $content,
            'user_id' => $id,
            'ip' => $ip
        ]);
    }

    public function scopeUpdateMsg($query,$id,$title,$content,$ip){
        $param = [
            'title'=>$title,
            'content'=>$content,
            'ip' => $ip
        ];
        $query->where('num',$id)->update($param);
    }



    
    public function scopeGetMsgs($query){
        return $query->with('user:id,name')->latest()->paginate(10);
    }


    public function scopeGetMsg($query,$id){
        return $query->with('user:id,name')->where('num',$id)->first();
    }

    public function scopeDeleteMsg($query,$col,$id){
        $query->where($col,$id)->delete();
    }


    public function scopeSearch($query,$col,$search){
        return $query->where($col,'LIKE',"%$search%")->latest('num')->paginate(10);
          
    }

    public function scopeSearchCount($query,$col,$search){
        return count($query->where($col,'LIKE',"%$search%")->get());
        
    }

    public function scopeSearchTitleAndCotent($query,$search){
        return $query->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->latest('num')->paginate(10);
    }

    public function scopeSearchTitleAndCotentCount($query,$search){
        return count( $query->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->get());
    }

    public function scopeUpdateHits($query,$id){
        $result = $query->where('num',$id)->first();
        $result->hits++;
        $result->save();
    }

    public function scopeUpdateCommend($query,$id){
        $result = $query->where('num',$id)->first();
        $result->commend++;
        $result->save();
    }

    public function scopeInsertComment($query,$content,$country,$board_id,$user_id,$ip){
        $param = [
            'content' => $content,
            'country' => $country,
            'board_id' => $board_id,
            'user_id' => $user_id,
            'ip' => $ip
        ];

        $query->create($param);
    }

    public function scopeGetComments($query,$id){
        return $query->with('user:id,name')->where('board_id',$id)->paginate(15);
    }

    public function scopeUpdateComments($query,$id,$content,$ip){
        $query->where('id',$id)->update(['content'=>$content,'ip' => $ip]);
    }

}

?>