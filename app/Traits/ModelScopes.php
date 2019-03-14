<?php

namespace App\Traits;

trait ModelScopes{
    
    // public function setCountryAttribute($value){
    //     if($value == "한국"){
    //         $this->attributes['country'] = asset("/data/ProjectImages/community/korea.png"); 
    //     }else if($value == "일본"){
    //         $this->attributes['country'] = asset("/data/ProjectImages/community/japan.png");
    //     }
    // }

    // public function getCountryImageAttribute(){
    //     if($this->country == "한국"){
    //         return asset("/data/ProjectImages/community/korea.png"); 
    //     } else if($this->country == "일본"){
    //         return asset("/data/ProjectImages/community/japan.png");
    //     }
    // }

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
        return $query->with('user:id,name')->orderBy('created_at','desc')->paginate(10)->onEachSide(5);
    }


    public function scopeGetMsg($query,$id){
        return $query->with('user:id,name')->where('num',$id)->first();
    }

    public function scopeDeleteMsg($query,$id){
        $query->where('num',$id)->delete();
    }

    public function scopeSearchTitle($query,$search){
        return $query->where('title','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
          
    }

    public function scopeSearchTitleCount($query,$search){
        return count($query->where('title','LIKE',"%$search%")->get());
        
     }

    public function scopeSearchContent($query,$search){
        return $query->where('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10)->onEachSide(5);
    }

    public function scopeSearchContentCount($query,$search){
        return count($query->where('content','LIKE',"%$search%")->get());     
    }

    public function scopeSearchTitleAndCotent($query,$search){
        return $query->where('title','LIKE',"%$search%")->orWhere('content','LIKE',"%$search%")->orderBy('num', 'desc')->paginate(10);
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
        if($country == "한국"){
            $countryImg = asset("/data/ProjectImages/community/korea2.png"); 
        }else if($country == "일본"){
            $countryImg =  asset("/data/ProjectImages/community/japan2.png");
        }

        $param = [
            'content' => $content,
            'country' => $countryImg,
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

    public function scopeDeleteComments($query,$id){
        $query->where('id',$id)->delete();
    }
}

?>