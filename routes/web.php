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




/*초기화면*/
Route::get('/', function () {return view('home');});
Route::get('introduction','SubController@getIntroduction');//사이트 소개

/*로그인 및 회원가입*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*socialauth ouath*/
Route::get('socialauth/{social}', 'Auth\LoginController@redirect');
Route::get('socialauth/{social}/callback', 'Auth\LoginController@callback');



/*소셜라이트 유저 추가정보 양식*/ 
Route::get('socialite-register','SubController@getRegister')->name('socialite.register');  

/*닉네임 중복체크*/
Route::get('check-name','UserController@getUserName');
/*아이디/ 비밀번호 찾기 처리*/ 
Route::post('reset','UserController@postFindPassword')->name('user.reset');    

/*유저 정보*/
Route::group(['middleware' => ['auth']], function () { 
    
    /*유저 체크*/ 
    Route::get('user/check','SubController@getUser')->name('user.check');
    /*내정보 보기*/   
    Route::any('user/{id}','UserController@getUserInfo')->name('user.info')->middleware('user'); 
    /*소셜라이트 회원 정보 보기*/
    Route::any('socialiteUser','SubController@getUserInfo')->name('socialite.userInfo');     
    /*내정보 수정*/
    Route::put('update','UserController@putUpdateProfile')->name('user.update');
    /*회원 탈퇴 처리*/
    Route::get('destroy','UserController@getDestroy')->name('user.destroy');
    /*비밀번호 변경 폼*/       
    Route::get('password/{id}','UserController@getChanegePasswordFrom')->name('user.passwordFrom');
    /*회원 비밀번호 변경*/
    Route::put('update/{id}','UserController@putUpdatePasswords')->name('user.updatePassword');

});


/*지식교류 게시판*/
Route::resource('community','CommunityContoller');
Route::group(['middleware' => ['comment']], function () { 
    /*게시판 추천*/
    Route::put('community/increaseCommend/{id}','CommunityContoller@putIncreaseCommend')->name('community.increaseCommend');
    /*댓글 작성*/
    Route::post('community/comment/{id}','CommunityContoller@postInsertComment')->name('community.comment'); 
    /* 댓글 수정*/
    Route::put('community/comment/{id}','CommunityContoller@putUpdateComment')->name('community.comment.update');
    /* 댓글 삭제*/
    Route::get('/comment/{id}','CommunityContoller@getDeleteComment')->name('community.comment.delete');
});

