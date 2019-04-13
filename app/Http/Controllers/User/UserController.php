<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Exception;
use Event;
use App\Events\ResetPwMail;

use Auth;
use App\Models\Users\User;




class UserController extends Controller 
{
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


    //유저 비밀번호 확인
    public function getUserInfo(Request $request){
         return view('auth.profile');
    }
   
    
    //회원정보 수정 자기소개글 삽입 및 대표사진
    public function putUpdateProfile(Request $request){

        if(session('locale') == 'ja'){
            $message = '会員情報が修正されました';
        }else{
            $message = '회원정보가 수정되었습니다.';
        }

        
      if($request->file){
        $file_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs(
            'users_profile_photo',
            $file_name,
            's3'
        );
        
        $this->userModel->updateFile($file_name);  
      }

      $this->userModel->updateProfile($request->gender,$request->age,$request->address,$request->country,$request->selfContext);
      

        return 
            redirect('home')
            ->with('message',$message);
    }


    //비밀번호 변경 폼
    public function getChanegePasswordFrom(){
        return view('auth.change_Password_Form');
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


      //내정보 보기
      public function getUser(){
          return view('auth.profile_check');
        }

      /*소셜라이트 회원 가입양식*/ 
      public function getRegister(){
          return view('auth.socialiteRegister');
      }


}

