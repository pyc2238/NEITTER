<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\StoreImage;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Events\ResetPwMail;
use Exception;
use Event;
use Auth;

use App\Models\Users\User;

class ProfileController extends Controller
{
    use StoreImage;

    private $userModel = null;

    public function __construct(){
        $this->userModel = new User();
    }


    /* 이메일 비밀번호 변경  */
    public function postFindPassword(Request $request){
        
        $randPw = array("@zxc123456", "!zxc123456", "#zxc123456", "&zxc123456");
        $selected = array_rand($randPw);
        session(['newPw' => $randPw[$selected]]);
        
        if(session('locale') == 'ja'){
            $message = 'メール情報が存在しません';
        }else{
            $message = '해당 이메일 정보가 존재하지 않습니다.';
        }

        
        $user = $this->userModel->getUser('email',$request->email);
        
        if(!$user){return back()->with('message',$message);} 

        if($request->email == $user->email){
            
            Event::fire(new ResetPwMail($request->email,$user->name));
            
            $this->userModel->findPassword($request->email,$randPw[$selected]);
        
            return view('auth.passwords.reset');
        }
    }


    //회원정보 수정 자기소개글 삽입 및 대표사진
    public function putUpdateProfile(Request $request){

        if(session('locale') == 'ja'){
            $message = '会員情報が修正されました';
        }else{
            $message = '회원정보가 수정되었습니다.';
        }

        
        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['profile']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

            $this->userModel->updateFile($file);  
        }

    $this->userModel->updateProfile(
        $request->gender,
        $request->age,
        $request->address,
        $request->country,
        $request->selfContext
    );
    
        return 
            redirect('home')
            ->with('message',$message);
    }



      //비밀번호 변경
      public function putUpdatePasswords(Request $request){
        
        $upw = $request->password;
        $new_pw = $request->new_password;
        $new_pw_check = $request->new_password_check;
        $pw = Auth::user()->password;

        if(password_verify($upw,$pw)){
            if($new_pw == $new_pw_check){

                $this->userModel->updatePassword($new_pw_check);

                    
            if(session('locale') == 'ja'){
                $message = 'パスワードの変更が完了しました。';
            }else{
                $message = '비밀번호 변경이 완료되었습니다.';
            }
    
                return redirect('home')->with('message',$message)->with(Auth::logout());;
            }else{
                        
                if(session('locale') == 'ja'){
                    $message = 'パスワードの確認が一致しません。';
                }else{
                    $message = '비밀번호 확인이 일치하지 않습니다.';
                }
        
              return back()->with('message',$message);
            }
        }else{

            if(session('locale') == 'ja'){
                $message = '会員情報パスワードが一致しません';
            }else{
                $message = '회원정보 비밀번호가 일치하지 않습니다.';
            }

            return back()->with('message',$message);
        }
    }

}
