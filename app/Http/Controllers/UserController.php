<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session; 

class UserController extends Controller
{
    
    //회원가입 닉네임 중복확인
    public function CheckName(Request $request){
        $uname = $request->name;
        $name = User::where('name',$uname)->first();           
     return view('auth.check_name')->with('uname',$uname)->with('name',$name);
     }

    //이메일 비밀번호 변경
    public function find(Request $request){
        $randPw = array("@zxc123456", "!zxc123456", "#zxc123456", "&zxc123456");
        $selected = array_rand($randPw);
        $newPw = $randPw[$selected];
        Session::put('newPw',$newPw);

        $uemail = $request->email;
         $email = User::where('email',$uemail)->first();
         if(!$email){
            return back()->with('message','해당 이메일 정보가 존재하지 않습니다.');    
        } 

         $uname = $email->name; 
         
     if($uemail == $email->email){
         Mail::send(['html'=>'component.mail'],['name','Sathak'],function($message) use ($uemail,$uname){
             $message->to($uemail,$uname.'님')->subject('안녕하세요 NEITTER입니다.');
             $message->from('pyc2238@gmail.com','보근');
         });
        
         
         $user = User::where('email',$uemail)->first();
         $user->password = Hash::make($newPw);
         $user->save();
         
             return view('auth.passwords.reset');
         }
    }

    //유저 비밀번호 확인
    public function userInfo(Request $request){
       $upw = $request->password;
       $pw = Auth::user()->password;

       //password_verify() : hash암호를 해석
       if(password_verify($upw,$pw)){
            return view('auth.profile');
        }else{
            return back()->with('message','회원 정보와 비밀번호가 일치하지 않습니다.');
        }
    }

    //회원정보 수정 자기소개글 삽입
    public function updateSelfContext(Request $request){
        
         $result = User::find(Auth::user()->id);
         $result->selfContext = $request->selfContext;
         $result->save(); 
         return redirect('home')->with('message','회원정보가 수정되었습니다.');
    }

    //비밀번호 변경 폼
    public function ChangePasswordFrom(){
        return view('auth.change_Password_Form');
    }

    //비밀번호 변경
    public function updatePassword(Request $request){
        
        $upw = $request->password;
        $new_pw = $request->new_password;
        $new_pw_check = $request->new_password_check;
        $pw = Auth::user()->password;

        if(password_verify($upw,$pw)){
            if($new_pw == $new_pw_check ){
                $result = User::find(Auth::user()->id);
                $result->password = Hash::make($new_pw_check);
                $result->save(); 
                Auth::logout();
                return redirect('home')->with('message','비밀번호 변경이 완료되었습니다.');
            }else{
              return back()->with('message','비밀번호 확인이 일치하지 않습니다.');
            }
        }else{
            return back()->with('message','회원정보 비밀번호가 일치하지 않습니다.');
        }
    }

    //회원 탈퇴
    public function destroy(){
        User::find(Auth::user()->id)->delete();
        
        return redirect(route('home'))->with('message','회원탈퇴가 완료되었습니다.');
    }


}
