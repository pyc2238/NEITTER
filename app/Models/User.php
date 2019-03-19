<?php

namespace App\Models;

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
    
    




    
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }


    public function getUser($col,$arg){
        return $this->where($col,$arg)->first();
    }


    public function findPassword($email,$password){
        $user = $this->where('email',$email)->first();
        $user->password = $password;
        $user->save();
    }

    public function updateProfile($gender,$age,$address,$country,$selfContext){
        $param = [
            'gender' => $gender,
            'age' => $age,
            'address' => $address,
            'country' => $country,
            'selfContext' => $selfContext
        ];

        $this->where('id',Auth::user()->id)
            ->update($param);
    }

    public function updatePassword($password){
        Auth::user()->password = $password;
        Auth::user()->save();
    }

    public function updateFile($file){
        $this->where('id',Auth::user()->id)
            ->update(['selfPhoto' => $file]);
    }

  
}
