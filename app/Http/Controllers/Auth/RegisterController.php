<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Session; 
use Event;
use Mail;
use App\Events\SendMail;

use Auth;
use App\User;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


   
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User();
    }

    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {

        
        $result = true;
        

        if($this->user->getName($request->name)){

            if(Session::get('locale') == 'ja'){
                $message = 'このIDは使用できません';
            }else{
                $message = '해당 아이디는 사용 할 수 없습니다.';
            }
            return back()->with('message',$message);
        }


        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:15|regex:/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/|confirmed',
        ]);

        $uname = $request->name;
        $uemail = $request->email;
        $upassword = $request->password;
        $ugender = $request->gender; 
        $uage = $request->age;
        $uaddress = $request->address;
        $ucountry = $request->country;

        Session::put('newUser',$uname);

        Event::fire(new SendMail($uemail,$uname));
        
        $request->session()->flush();

        $this->user->createUser($uname,$uemail,$upassword,$ugender,$uage,$uaddress,$ucountry);

        return redirect('login')->with('result',$result);
        
    }

}

