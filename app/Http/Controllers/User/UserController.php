<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Exception;
use Event;
use App\Events\ResetPwMail;


use App\Http\Controllers\Helper\StoreImage;

use Auth;
use App\Models\Users\User;

class UserController extends Controller 
{
    use StoreImage;

    private $userModel = null;

    public function __construct(){
        $this->userModel = new User();
    }


    /* 회원가입 닉네임 중복 체크 */
    public function getUserName(Request $request){
 
        $user = $this->userModel->getUser('name',$request->name);

        return 
            view('auth.check_name')
            ->with('uname',$request->name)
            ->with('name',$user['name']);
     }


    
    //회원 탈퇴
    public function getDestroy(Request $request){
      
        if(session('locale') == 'ja'){
            $message = '会員脱退が完了しました。';
        }else{
            $message = '회원탈퇴가 완료되었습니다.';
        }

        User::where('id',Auth::user()->id)->delete();
        $request->session()->flush();
        return 
            redirect(route('login'))
            ->with('message',$message);
    }

}

