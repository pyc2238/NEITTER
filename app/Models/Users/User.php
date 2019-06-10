<?php

namespace App\Models\Users;

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
        'penpal_count',
    ];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $dates = ['deleted_at'];

    public function communities(){
        return $this->hasMany('App\Models\Communities\Community');
    }

    public function comments(){
        return $this->hasMany('App\Models\Communities\Communities_Comment');
    }

    public function admin__notices(){
        return $this->hasMany('App\Models\Admins\Admin_Notice');
    }

    public function inquiryBoards(){
        return $this->hasMany('App\Models\inquiries\inquiryBoard');
    }

    public function penpal(){
        return $this->hasMany('App\Models\Penpal\Penpal');
    }
    
    
    public function timeline(){
        return $this->hasMany('App\Models\Penpal\Timeline');
    }
   
    public function sender(){
        return $this->hasMany('App\Models\Penpal\Sender');
    }

    public function  transmit(){
        return $this->hasMany('App\Models\Penpal\Transmit');
    }
    
    public function translationRecord(){
        return $this->hasMany('App\Models\Users\TranslationRecord');
    }

    public function friend(){
        return $this->hasMany('App\Models\Users\Friend');
    }


       //penpals테이블 user테이블 N-N (중간테이블 visitors)
       public function visitor_penapl(){
        return $this->belongsToMany('App\Models\Users\User','visitors');
    }

      //penpals테이블 user테이블 N-N (중간테이블 winks)
      public function wink_penpal(){
        return $this->belongsToMany('App\Models\Users\User','winks')->withPivot('created_at');
    }

    //password Mutators
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }


    public function getUser($col,$arg){
        return $this->where($col,$arg)->first();
    }


    public function findPassword($email,$password){

        // $this::where('email',$email)
        //     ->update(['password' => $password]);

        $user = $this->where('email',$email)->first();
        $user->password = $password;
        $user->save();
    }


    public function updateProfile($gender,$age,$address,$country,$selfContext){
        $param = [
            'gender'        => $gender,
            'age'           => $age,
            'address'       => $address,
            'country'       => $country,
            'selfContext'   => $selfContext
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
