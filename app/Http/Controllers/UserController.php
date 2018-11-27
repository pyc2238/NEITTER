<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session; 
use Mail;
use Auth;
use App\User;


class UserController extends Controller 
{


    public function __construct(){
        $this->userModel = new User();
    }


    /* 회원가입 닉네임 중복 체크 */
    public function CheckName(Request $request){
        $name =  $this->userModel->getName($request->name);

        return 
            view('auth.check_name')
            ->with('uname',$request->name)
            ->with('name',$name);
     }


    /* 이메일 비밀번호 변경  */
    public function find(Request $request){
        $randPw = array("@zxc123456", "!zxc123456", "#zxc123456", "&zxc123456");
        $selected = array_rand($randPw);
        Session::put('newPw',$randPw[$selected]);

        $uemail = $request->email;
        $email = $this->userModel->getEmail($uemail);

        if(!$email){return back()->with('message','해당 이메일 정보가 존재하지 않습니다.');} 

        $uname = $email->name; 
         
        if($uemail == $email->email){
            Mail::send(['html'=>'component.mail'],['name','Sathak'],function($message) use ($uemail,$uname){
                $message->to($uemail,$uname.'님')->subject('안녕하세요 NEITTER입니다.');
                $message->from('pyc2238@gmail.com','보근');
            });
        
         $this->userModel->changePassword($uemail,$randPw[$selected]);
          
         return view('auth.passwords.reset');
         }
    }


    //유저 비밀번호 확인
    public function userInfo(Request $request){
         return view('auth.profile');
    }
   
    
    //회원정보 수정 자기소개글 삽입
    public function updateSelfContext(Request $request){
        
        $this->userModel->updateSelfContext($request->selfContext);

        return 
            redirect('home')
            ->with('message','회원정보가 수정되었습니다.');
    }


    //비밀번호 변경 폼
    public function ChangePasswordFrom(){
        return view('auth.change_Password_Form');
    }


    //비밀번호 변경
    public function updatePasswords(Request $request){
        
        $upw = $request->password;
        $new_pw = $request->new_password;
        $new_pw_check = $request->new_password_check;
        $pw = Auth::user()->password;

        if(password_verify($upw,$pw)){
            if($new_pw == $new_pw_check){
                $this->userModel->updatePassword($new_pw_check);
                return redirect('home')->with('message','비밀번호 변경이 완료되었습니다.')->with(Auth::logout());;
            }else{
              return back()->with('message','비밀번호 확인이 일치하지 않습니다.');
            }
        }else{
            return back()->with('message','회원정보 비밀번호가 일치하지 않습니다.');
        }
    }

    
    //회원 탈퇴
    public function destroy(){
      
        User::where('id',Auth::user()->id)->delete();

        return 
            redirect(route('home'))
            ->with('message','회원탈퇴가 완료되었습니다.');
    }

}

