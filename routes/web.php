<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*초기화면*/
Route::get('/', function () {return view('home');});
Route::get('introduction','SubController@introduction');//사이트 소개

/*로그인 및 회원가입*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*닉네임 중복체크*/
Route::get('check_name','UserController@CheckName');
/*아이디/ 비밀번호 찾기 처리*/ 
Route::post('reset','UserController@find')->name('reset');    

/*유저 정보*/
Route::group(['middleware' => ['auth']], function () { 
    
    /*유저 체크*/ 
    Route::get('user/check','SubController@userCheck')->name('CheckUser');
    /*내정보 보기*/   
    Route::any('user/{id}','UserController@userInfo')->name('UserInfo')->middleware('user');   
    /*내정보 수정*/
    Route::put('update','UserController@updateProfile')->name('update');
    /*회원 탈퇴 처리*/
    Route::get('destroy','UserController@destroy')->name('destroy');
    /*비밀번호 변경 폼*/       
    Route::get('password/{id}','UserController@ChangePasswordFrom')->name('password.from');
    /*회원 비밀번호 변경*/
    Route::put('update/{id}','UserController@updatePasswords')->name('password.updatePassword');
});


/*지식교류 게시판*/
Route::resource('community','CommunityContoller');
Route::group(['middleware' => ['comment']], function () { 
    /*게시판 추천*/
    Route::put('community/increaseCommend/{id}','CommunityContoller@increaseCommend')->name('community.increaseCommend');
    /*댓글 작성*/
    Route::post('community/comment/{id}','CommunityContoller@insertComment')->name('community.comment'); 
    Route::put('community/comment/{id}','CommunityContoller@updateComment')->name('community.comment.update');
    Route::get('/comment/{id}','CommunityContoller@deleteComment');
    Route::get('/translation/{id}','CommunityContoller@translationComment');
});



