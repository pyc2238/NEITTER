<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

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
    ];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function communities(){
        return $this->hasMany(Community::class);
    }

    public function comments(){
        return $this->hasMany(Communities_Comment::class);
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

    public function updateSelfContext($selfContext){
        $this::where('id',Auth::user()->id)
            ->update(['selfContext' => $selfContext]);
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
