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

/*언어 지역화*/
Route::get('locale/{locale}',function($locale = 'ko'){
    Session::put('locale',$locale);
    return redirect()->back();
});

/*CkEditor 파일업로드*/
Route::post('/ckUpload', 'Helper\FileUploadController@fileUpload')->name('ckUpload');
// 이미지 새창
Route::get('/image', 'Home\WelcomeController@viewImage')->name('image.view');


// papago 번역기
Route::post('translation', 'Home\TranslationController@languageTranslation')->name('translation')->middleware('auth');
Route::post('translation/recodes', 'Home\TranslationController@getRecodes')->name('translation.recodes')->middleware('auth');
Route::post('translation/delete', 'Home\TranslationController@recodeDelete')->name('translation.recode.delete')->middleware('auth');
Route::post('translation/allDelete', 'Home\TranslationController@recodeAllDelete')->name('translation.recode.allDelete')->middleware('auth');


/*메인 페이지*/
Route::get('/', 'Home\WelcomeController@index');
Route::resource('home', 'Home\WelcomeController');
Route::get('introduction', 'Home\WelcomeController@getIntroduction')->name('home.introduction');//사이트 소개
Route::get('policy', 'Home\WelcomeController@getPolicy')->name('home.policy');//이용 약관
Route::get('creator', 'Home\WelcomeController@getCreator')->name('home.creator');//크리에이터
Route::get('development', 'Home\WelcomeController@getDevelopment')->name('home.development');//크리에이터
/*로그인 및 회원가입*/
Auth::routes();
/*socialauth ouath*/
Route::get('socialauth/{social}', 'Auth\LoginController@redirect');
Route::get('socialauth/{social}/callback', 'Auth\LoginController@callback');
/*소셜라이트 유저 추가정보 양식*/ 
Route::get('socialite-register', 'User\ViewController@getRegister')->name('socialite.register');  
/*닉네임 중복체크*/
Route::get('check-name', 'User\UserController@getUserName');
/*아이디/ 비밀번호 찾기 처리*/ 
Route::post('reset', 'User\ProfileController@postFindPassword')->name('user.reset');    
/*유저 정보*/
Route::group(['middleware' => ['auth']], function () { 
    
    /*유저 체크*/ 
    Route::get('user/check', 'User\ViewController@getUser')->name('user.check');
    /*내정보 보기*/   
    Route::any('user/{id}', 'User\ViewController@getUserInfo')->name('user.info')->middleware('user');    
    /*내정보 수정*/
    Route::put('update', 'User\ProfileController@putUpdateProfile')->name('user.update');
    /*회원 탈퇴 처리*/
    Route::get('destroy', 'User\UserController@getDestroy')->name('user.destroy');
    /*비밀번호 변경 폼*/       
    Route::get('password/{id}', 'User\ViewController@getChanegePasswordFrom')->name('user.passwordFrom');
    /*회원 비밀번호 변경*/
    Route::put('update/{id}', 'User\ProfileController@putUpdatePasswords')->name('user.updatePassword');
    /*회원 친구 추가*/
    Route::post('create/friend', 'User\FriendController@addFriend')->name('user.create.friend');
});
/*지식교류 게시판*/
Route::resource('community', 'Community\CommunityContoller');
/*불편및 문의사항 게시판 */
Route::resource('inquiry', 'inquiryBoard\inquiryBoardController');
Route::group(['middleware' => ['comment']], function () { 
    /*지식교류 게시판 추천*/
    Route::put('community/increaseCommend/{id}', 'Community\CommendController@putIncreaseCommend')->name('community.increaseCommend');
    /*지식 교류 댓글 작성*/
    Route::post('community/comment/{id}', 'Community\CommentController@postInsertComment')->name('community.comment'); 
    /* 지식 교류 댓글 수정*/
    Route::put('community/comment/{id}', 'Community\CommentController@putUpdateComment')->name('community.comment.update');
    /*지식 교류 댓글 삭제*/
    Route::get('community/comment/{id}', 'Community\CommentController@getDeleteComment')->name('community.comment.delete');
   
    /*문의 게시판 추천*/
    Route::put('inquiry/increaseCommend/{id}', 'inquiryBoard\CommendController@putIncreaseCommend')->name('inquiry.increaseCommend');/*댓글 작성*/
    /* 문의 게시판 댓글 작성*/
    Route::post('inquiry/comment/{id}', 'inquiryBoard\CommentController@postInsertComment')->name('inquiry.comment'); 
    /* 문의 게시판 댓글 수정*/
    Route::put('inquiry/comment/{id}', 'inquiryBoard\CommentController@putUpdateComment')->name('inquiry.comment.update');
    /* 문의 게시판 댓글 삭제*/
    Route::get('inquiry/comment/{id}', 'inquiryBoard\CommentController@getDeleteComment')->name('inquiry.comment.delete');
});

/*공지사항 게시판 */
Route::resource('notice', 'Admin\NoticeBoardController');


/*펜팔 서비스*/
Route::group(['prefix' => 'penpal'], function () {

    Route::match(['get','post'], '/search', 'Penpal\ViewController@index')->name('penpal.index.search');
    Route::match(['get','post'], '/index', 'Penpal\ViewController@index')->name('penpal.index');
    Route::get('/introduction', 'Penpal\ViewController@introduction')->name('penpal.introduction');
    Route::get('/timeline', 'Penpal\ViewController@timeline')->name('penpal.timeline');
    Route::get('/timeline/delete', 'Penpal\TimelineController@delete')->name('penpal.timeline.delete')->middleware('auth');;
    Route::get('/registration', 'Penpal\ViewController@registration')->name('penpal.registration')->middleware('auth');
    Route::get('/friends/{id}', 'Penpal\ViewController@show')->name('penpal.friends')->middleware('auth');
    Route::post('/sendmail', 'Penpal\PenpalController@penpal')->name('penpal.sendMail')->middleware('auth');
    Route::post('/registration', 'Penpal\RegisterController@registration')->name('penpal.penpal.registration')->middleware('auth');
    Route::post('/timeline', 'Penpal\TimelineController@create')->name('penpal.timeline.create')->middleware('auth');
    Route::post('/timeline/update', 'Penpal\TimelineController@update')->name('penpal.timeline.update')->middleware('auth');
    Route::group(['prefix' => 'show','middleware' => 'auth'], function () {
        Route::get('/edit/{id}', 'Penpal\ViewController@edit')->name('penpal.show.edit');
        Route::post('/update', 'Penpal\ShowPenpalController@penpalUpdate')->name('penpal.show.update');
        Route::get('/delete', 'Penpal\ShowPenpalController@penpalDelete')->name('penpal.show.delete');
        Route::get('/timeline/delete', 'Penpal\ShowPenpalController@showTimelineDelete')->name('penpal.show.timeline.delete');
        Route::post('/timeline/update', 'Penpal\ShowPenpalController@showTimelineUpdate')->name('penpal.show.timeline.update');
        Route::post('/wink', 'Penpal\ShowPenpalController@wink')->name('penpal.show.wink');
    });
});

Route::group(['prefix' => 'mail','middleware' => 'auth'], function () {
    Route::get('/inbox', 'Mail\ViewController@inbox')->name('mail.inbox');
    Route::get('/transmit', 'Mail\ViewController@transmit')->name('mail.transmit');
    Route::get('/send', 'Mail\ViewController@sendMail')->name('mail.sendMail');
    Route::get('/show/{id}', 'Mail\ViewController@show')->name('mail.show');
    Route::get('transmit/show/{id}', 'Mail\ViewController@transmitShow')->name('mail.transmit.show');
    Route::get('/delete', 'Penpal\PenpalController@deleteMail')->name('mail.delete');
    Route::get('transmit/delete', 'Penpal\PenpalController@transmitDeleteMail')->name('mail.transmit.delete');
    Route::get('/count', 'Penpal\PenpalController@mailCount')->name('mail.count');
});


/*포럼 게시판*/
Route::resource('forum', 'Forum\ForumController');
