<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Users\Friend;

class FriendController extends Controller
{

    private $friendModel = null;

    public function __construct(){
        $this->friendModel = new Friend();
    }

    
    public function addFriend(Request $request){
    
        //수신자의 친구목록에 송신자를 추가
        $friendModelData = array(
            'user_id'   => Auth::id(),
            'friend_id' => $request->friend_id,
            'is_friend' => 1,
        );
        
        //송신자의 친구목록에 수신자를 추가
        $friendModelData2 = array(
            'user_id'   => $request->friend_id,
            'friend_id' => Auth::id(),
            'is_friend' => 1,
        );

        $this->friendModel->create($friendModelData);
        $this->friendModel->create($friendModelData2);
    
    }


}
