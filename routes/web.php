<?php

/*
|--------------------------------------------------------------------------
| REST API 설계 규칙
|--------------------------------------------------------------------------
|1.URI는 정보의 자원을 표현해야한다.
|2.자원에 대한 행위는 HTTP Metohd(GET,POST,PUT,DELETE)로 표현한다.
|3.슬래시 구분자(/)는 계층 관계를 나타내는데 사용한다.
|4.Method 작명은 HTTP와 처리 할 액션으로 구성한다. 
|
|
*/

/**test */


/*언어 지역화*/
Route::get('locale/{locale}',function($locale = 'ko'){
    Session::put('locale',$locale);
    return redirect()->back();
});

/*메인 페이지*/
Route::get('/','Home\WelcomeController@index');
Route::resource('home','Home\WelcomeController');
Route::get('Home\introduction','Home\WelcomeController@getIntroduction')->name('home.introduction');//사이트 소개

/*로그인 및 회원가입*/
Auth::routes();

/*socialauth ouath*/
Route::get('socialauth/{social}', 'Auth\LoginController@redirect');
Route::get('socialauth/{social}/callback', 'Auth\LoginController@callback');

/*소셜라이트 유저 추가정보 양식*/ 
Route::get('socialite-register','User\UserController@getRegister')->name('socialite.register');  

/*닉네임 중복체크*/
Route::get('check-name','User\UserController@getUserName');
/*아이디/ 비밀번호 찾기 처리*/ 
Route::post('reset','User\UserController@postFindPassword')->name('user.reset');    

/*유저 정보*/
Route::group(['middleware' => ['auth']], function () { 
    
    /*유저 체크*/ 
    Route::get('user/check','User\UserController@getUser')->name('user.check');
    /*내정보 보기*/   
    Route::any('user/{id}','User\UserController@getUserInfo')->name('user.info')->middleware('user'); 
    /*소셜라이트 회원 정보 보기*/
    Route::any('socialiteUser','User\UserController@getSocialiteUserInfo')->name('socialite.userInfo');     
    /*내정보 수정*/
    Route::put('update','User\UserController@putUpdateProfile')->name('user.update');
    /*회원 탈퇴 처리*/
    Route::get('destroy','User\UserController@getDestroy')->name('user.destroy');
    /*비밀번호 변경 폼*/       
    Route::get('password/{id}','User\UserController@getChanegePasswordFrom')->name('user.passwordFrom');
    /*회원 비밀번호 변경*/
    Route::put('update/{id}','User\UserController@putUpdatePasswords')->name('user.updatePassword');

});

/*지식교류 게시판*/
Route::resource('community','Community\CommunityContoller');
Route::group(['middleware' => ['comment']], function () { 
    /*게시판 추천*/
    Route::put('community/increaseCommend/{id}','Community\CommunityContoller@putIncreaseCommend')->name('community.increaseCommend');
    /*댓글 작성*/
    Route::post('community/comment/{id}','Community\CommunityContoller@postInsertComment')->name('community.comment'); 
    /* 댓글 수정*/
    Route::put('community/comment/{id}','Community\CommunityContoller@putUpdateComment')->name('community.comment.update');
    /* 댓글 삭제*/
    Route::get('/comment/{id}','Community\CommunityContoller@getDeleteComment')->name('community.comment.delete');
});

/*포럼 게시판*/
Route::resource('forum','Forum\ForumController');
