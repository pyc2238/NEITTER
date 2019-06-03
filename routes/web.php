<?php
use App\Events\CommunityPusher;
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
/**Pusher test */

Route::get('/counter', function () {
    return view('counter');
});
Route::get('/sender', function () {
    return view('sender');
});
Route::post('/sender', function () {
    $text = request()->text;
    
    event(new CommunityPusher($text));
    
});



///////////////////////////////////////////////////////



/*언어 지역화*/
Route::get('locale/{locale}',function($locale = 'ko'){
    Session::put('locale',$locale);
    return redirect()->back();
});

/*CkEditor 파일업로드*/
Route::post('/ckUpload', 'Helper\FileUploadController@fileUpload')->name('ckUpload');

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
    Route::get('/friends/{id}', 'Penpal\ViewController@show')->name('penpal.friends');
    Route::post('/registration', 'Penpal\RegisterController@registration')->name('penpal.penpal.registration')->middleware('auth');
    Route::post('/timeline', 'Penpal\TimelineController@create')->name('penpal.timeline.create')->middleware('auth');
    Route::post('/timeline/update', 'Penpal\TimelineController@update')->name('penpal.timeline.update')->middleware('auth');
    Route::group(['prefix' => 'show'], function () {
        Route::get('/edit', 'Penpal\ViewController@edit')->name('penpal.show.edit');
        Route::post('/update', 'Penpal\ShowPenpalController@penpalUpdate')->name('penpal.show.update');
        Route::get('/timeline/delete', 'Penpal\ShowPenpalController@showTimelineDelete')->name('penpal.show.timeline.delete');
        Route::post('/timeline/update', 'Penpal\ShowPenpalController@showTimelineUpdate')->name('penpal.show.timeline.update');
    });
});


/*포럼 게시판*/
Route::resource('forum', 'Forum\ForumController');