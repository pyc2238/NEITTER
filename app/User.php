<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'gender',
        'age',
        'address',
        'country',
        'email',
        'socialite',
    ];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $dates = ['deleted_at'];

    public function communities(){
        return $this->hasMany(Community::class);
    }

    public function comments(){
        return $this->hasMany(Communities_Comment::class);
    }

    public function admin__notices(){
        return $this->hasMany(Admin_Notice::class);
    }

    public function inquiryBoards(){
        return $this->hasMany(inquiryBoard::class);
    }
    
    


    public function createUser($uname,$uemail,$upassword,$ugender,$uage,$uaddress,$ucountry){

        $param = [
            'name' => $uname,
            'email' => $uemail,
            'password' =>Hash::make($upassword),
            'gender' => $ugender,
            'age' => $uage,
            'address' => $uaddress,
            'country' => $ucountry
        ];

        $this::create($param);
    
    }

    public function getName($name){
        return $this::where('name',$name)->first();  
    }
    

    public function getEmail($email){
        return $this::where('email',$email)->first();
    }

    public function changePassword($email,$newPw){
        $this::where('email',$email)
            ->update(['password' => Hash::make($newPw)]);
    }

    public function updateProfile($gender,$age,$address,$country,$selfContext){
        $param = [
            'gender' => $gender,
            'age' => $age,
            'address' => $address,
            'country' => $country,
            'selfContext' => $selfContext
        ];

        $this::where('id',Auth::user()->id)
            ->update($param);
    }

    public function updatePassword($password){
        $this::where('id',Auth::user()->id)
            ->update(['password' =>Hash::make($password)]);
    }

    public function updateFile($file){
        $this::where('id',Auth::user()->id)
            ->update(['selfPhoto' => $file]);
    }

  
}
