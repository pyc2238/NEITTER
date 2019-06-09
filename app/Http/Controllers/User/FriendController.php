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
    
        $friendModelData = array(
            'user_id'   => Auth::id(),
            'friend_id' => $request->friend_id,
            'is_friend' => 1,
        );

        $this->friendModel->create($friendModelData);
    
    }
}
