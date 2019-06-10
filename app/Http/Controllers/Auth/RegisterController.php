<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\CreateUserRequest;

use Event;
use Mail;
use App\Events\SendMail;

use Auth;
use App\Models\Users\User;
use App\Models\Users\Point;

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

    private $userModel  = null;
    private $pointModel = null;

    public function __construct()
    {
        $this->middleware('guest');
        $this->userModel    = new User();
        $this->pointModel   = new Point();
    }

    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(CreateUserRequest $request)
    {

        
        $result = true;
        

        if($this->userModel->getUser('name',$request->name)){

            if(session('locale') == 'ja'){
                $message = 'このIDは使用できません';
            }else{
                $message = '해당 아이디는 사용 할 수 없습니다.';
            }
            return back()->with('message',$message);
        }

        $user = $this->userModel->create(request()->all());
        
        $this->pointModel->insert([
               'user_id' => $user->id,
            ]);

        session(['newUser' => $user->name]);

        Event::fire(new SendMail($user->email,$user->name));
        
        $request->session()->flush();

        return redirect('login')->with('result',$result);
        
    }

}

