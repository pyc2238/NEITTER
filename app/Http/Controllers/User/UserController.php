<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session; 
use Mail;
use Exception;
use Event;
use App\Events\ResetPwMail;

use Auth;
use App\User;




class UserController extends Controller 
{


    public function __construct(){
        $this->userModel = new User();
    }


    /* 회원가입 닉네임 중복 체크 */
    public function getUserName(Request $request){
        $name =  $this->userModel->getName($request->name);

        return 
            view('auth.check_name')
            ->with('uname',$request->name)
            ->with('name',$name);
     }


    /* 이메일 비밀번호 변경  */
    public function postFindPassword(Request $request){
        $randPw = array("@zxc123456", "!zxc123456", "#zxc123456", "&zxc123456");
        $selected = array_rand($randPw);
        $request->session()->put('newPw',$randPw[$selected]);

        $uemail = $request->email;
        $email = $this->userModel->getEmail($uemail);

        if(!$email){return back()->with('message','해당 이메일 정보가 존재하지 않습니다.');} 

        $uname = $email->name; 
         
        if($uemail == $email->email){
            
            Event::fire(new ResetPwMail($uemail,$uname));
            
            $this->userModel->changePassword($uemail,$randPw[$selected]);
          
            return view('auth.passwords.reset');
         }
    }


    //유저 비밀번호 확인
    public function getUserInfo(Request $request){
         return view('auth.profile');
    }
   
    
    //회원정보 수정 자기소개글 삽입 및 대표사진
    public function putUpdateProfile(Request $request){
        
        
      if($request->file){
        $file_name = $request->file('file')->getClientOriginalName();
        $request->file->storeAs('public/slefPhoto',$file_name);
        $this->userModel->updateFile($file_name);  
      }
    
      
      $this->userModel->updateProfile($request->gender,$request->age,$request->address,$request->country,$request->selfContext);
      

      

        return 
            redirect('home')
            ->with('message','회원정보가 수정되었습니다.');
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
                return redirect('home')->with('message','비밀번호 변경이 완료되었습니다.')->with(Auth::logout());;
            }else{
              return back()->with('message','비밀번호 확인이 일치하지 않습니다.');
            }
        }else{
            return back()->with('message','회원정보 비밀번호가 일치하지 않습니다.');
        }
    }

    
    //회원 탈퇴
    public function getDestroy(Request $request){
      
        User::where('id',Auth::user()->id)->delete();
        $request->session()->flush();
        return 
            redirect(route('home'))
            ->with('message','회원탈퇴가 완료되었습니다.');
    }


      //내정보 보기
      public function getUser(){return view('auth.profile_check');}

      /*소셜라이트 회원 가입양식*/ 
      public function getRegister(){
          return view('auth.socialiteRegister');
      }

      /*소셜라이트 회원 내정보*/
      public function getSocialiteUserInfo(){
          return view('auth.socialiteProfile');
      }

}

