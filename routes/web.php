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

//초기화면
Route::get('/', function () {return view('home');});
Route::get('introduction','SubController@introduction');//사이트 소개

//로그인 및 회원가입
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('check_name','UserController@CheckName'); //닉네임 중복체크
Route::post('reset','UserController@find')->name('reset');    //아이디/ 비밀번호 찾기 처리

//유저 정보
Route::get('CheckUser','SubController@userCheck')->name('CheckUser');   //유저 체크
Route::post('UserInfo/{id}','UserController@userInfo')->name('UserInfo');   //내정보 보기
Route::put('update','UserController@updateSelfContext')->name('update');    //내정보 수정
Route::get('UserInfo/destroy','UserController@destroy') ;   //회원 탈퇴 처리
Route::get('ChangePassword/{id}','UserController@ChangePasswordFrom')->name('ChangePasswordFrom');// 비밀번호 변경 폼
Route::put('update/{id}','UserController@updatePassword')->name('updatePassword');//회원 비밀번호 변경