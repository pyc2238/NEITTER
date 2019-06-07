<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConstantEnum extends Controller
{
    const S3 =  [
        'profile'         => 'users_profile_photo',
        'penpal'          => 'users_penpal_photo',
        'timeline'        => 'users_penpal_timeline_photo',
        'penpal_user'     => 'users_penpal_mail_photo',
    ];
}
