@extends('layouts.app')
@section('title')
@lang('home/component/development.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/2.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/development.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>技術スタック</b></h4>
            <div class="row text-center">
                <div class="col">
                    <img src="{{asset("data/ProjectImages/master/WebSide.png")}}" alt="WebSideLog">

                    <br><b style="font-size:1.5rem;color:red">WebSide</b><br><hr>
                    <img src="{{ asset("data/ProjectImages/master/stack/html_css_js.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/jquery.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/ajax.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/bootstrap.png") }}" alt="WebSideLog" width="30%"><br><br>
                </div>
                <div class="col">
                    <img src="{{asset("data/ProjectImages/master/ServerSide.png")}}" alt="WebSideLog">

                    <br><b style="font-size:1.5rem;color:red">ServerSide</b><br><hr>
                    <img src="{{ asset("data/ProjectImages/master/stack/php.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/laravel.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/AWS.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/apache.png") }}" alt="WebSideLog" width="30%"><br>
                    </ul>
                </div>
                <div class="col">
                    <img src="{{asset("data/ProjectImages/master/DataBase.png")}}" alt="WebSideLog">

                    <br><b style="font-size:1.5rem;color:red">OS&DATABASE</b><br><hr>
                    <img src="{{ asset("data/ProjectImages/master/stack/ubuntu.png") }}" alt="WebSideLog" width="30%"><br>
                    <img src="{{ asset("data/ProjectImages/master/stack/mariadb.png") }}" alt="WebSideLog" width="30%"><br>

                </div>
            </div>

                <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;margin-top:12%''><b>開発現況</b></h4>
                <br>
                2018年10月2日~ing
                <br>
                <br>
                <ul style='margin-left:35px'>
                    <li><b>初開発開始の基本的な画面設計</b></li>
                    -2018年10月4日: サイトナビゲーションデザイン及びコンテンツ構想<br>
                    -2018年10月5日: メイン画面レイアウト設計<br>
                    -2018年10月9日: サイトコンテンツ及びデータベース構想<br>
                    -2018年10月12日: ソースコードの整理及びコメント作業<br><br>
                    <li><b>member機能開発開始</b></li>
                    -2018年10月18日: 会員加入機能の具現およびデータベース生成<br>
                    -2018年10月20日: ログイ ン及びログアウトのレイアウト設計及び実装<br>
                    -2018年10月22日: ログインID重複検査,PW正規表現式導入<br>
                    -2018年10月22日: 会員加入時の空白防止及び電子メール重複防止,会員脱会機能の追加,電子メールでのID検索及びパスワードの再設定<br>
                    -2018年10月24日: 会員プロフィール修正フォームおよび機能具現<br>
                    -2018年10月25日: 作文フォーム(NaverEdtior)の適用および電子メール正規式導入 <br><br>
                    <li><b>Community開発開始</b></li>
                    -2018年10月26日: データベース生成及びレイアウト設計<br>
                    -2018年10月27日: 掲示板のタイトルおよびニックネームの長さの制限,html文字の分かち書きの修正,国籍別イメージの出力,CRUD機能<br>
                    -2018年10月28日: CKeditor交替,掲示板デザイン修正およびページネーション<br>
                    <b style='color:red'>-2018年10月29日: PHP TermProject中間発表</b><br>
                    -2018年11月4日: 検索機能を追加<br>
                    -2018年11月5日: 検索機能ページネーションおよびタイトル+内容検索追加<br>
                    -2018年11月9日: 書き込みの書き込み機能CRUD<br>
                    -2018年11月10日: ネイバーパパAPI導入<br>
                    -2018年11月11日: 推薦·照会数の具現<br><br>
                    <li><b>Laravelフレームワーク転換</b></li>
                    -2018年11月12日: フォーラム·レイアウト·デザイン,パパゴ·言語感知機能の追加<br>
                    <b style='color:red'>-2018年11月14日: PHP->Laravel フレームワーク切り替え開始</b><br>
                    <img width="23%" src="{{asset("data/ProjectImages/master/umr2.png")}}" align="right" style="margin-right:8%">
                    -2018年11月15日: レイアウト及びラウトの設定<br>
                    -2018年11月16日: 会員加入及びログインORM転換1<br>
                    -2018年11月17日: 会員加入及びログインORM転換2<br>
                    -2018年11月18日: 掲示板CRUD ORM転換1<br>
                    -2018年11月19日: 掲示板CRUD ORM転換2<br>
                    -2018年11月20日: 掲示板CRUD ORM転換3<br>
                    -2018年11月21日: 掲示板CRUD ORM転換4<br>
                    -2018年11月22日: 掲示板CRUD ORM転換5<br>
                    <b style='color:red'>-2018年11月25日~12月1日現在で実装されたコード大幅修正</b><br>
                    -2018年12月1日: 会員加入時,メール発送追加<br>
                    -2018年12月2日: Googleユーザー認証ログインを追加<br>
                    -2018年12月9日: githubユーザー認証ログインを追加,および検索語自動完成機能を導入<br>
                    -2018年12月11日: 加入者確認メールスケジュール機能を追加<br>
                    <b style='color:red'>-2018年12月12日: プロジェクト提出(具現率20%)</b><br><br>
                    <li><b>言語の地域化</b></li>
                    -2018年1月7日: コントローラ階層の構造化,右マルコントローラ<br>
                    -2018年1月8日: footer Copyright<br>
                    -2018年1月9日:  日韓言語の地域化1<br>
                    -2018年1月10日: 日韓言語の地域化2<br>
                    -2018年1月10日: 日韓言語の地域化3<br>
                    -2018年1月12日: クリエーターページを追加<br>
                    -2018年1月14日: プロジェクトモデルペクトリーを追加<br><br>
                    <li><b>Notice お知らせ掲示板を追加</b></li>
                    -2018年1月14日: お知らせ掲示板を追加及びパパゴ翻訳関数モジュール化,アドミンユーザー追加<br>
                    -2018年1月15日: ModelクエリスコフTrait,会員脱退および掲示文脱退時の実行可否確認を追加<br>
                    <b style='color:red'>-2018年1月23日 AWS S3 ファイルアップロード機能を追加</b><br>
                    -2019年3月18日,モデル階層化及びRequestクラスの有効性検査の適用<br>
                    -2019년4월 10일: 開発者ノートページ追加<br>
                    -2019년4월 13일: 一般会員とソーシャルライト会員,ユーザープロフィール情報統合<br>
                    -2019년4월 26일: ファイルアップロード機能トラフィック転換<br>
                    <b style='color:red'>-2019年5月11日AWS RDS転換</b><br><br>
                    <li><b>ペンパルサービス開発開始</b></li>
                    -2019年5月22日: データベース1次設計<br>
                    -2019年5月23日: ペンパルページ設計<br>

                </ul>
            </div>
            <div class="w-100"></div>
            <div class="col" style='margin-top:40px'>
                <img width="23%" src="{{asset("data/ProjectImages/master/umr3.jpg")}}" align="right" style="margin-right:20%">
                <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>エラー修正日誌</b></h4>
                <ul style='margin-left:35px'>
                    <li><b>2018年1月11日</b></li>
                    プロフィール詳細表示性別地域化<br>
                    ログアウト時,地域化セッション処理<br>
                    ソーシャルライト処理<br>
                    メールの地域化<br>
                    ログアウト時,地域化セッション処理<br>
                    ログイン時のセッション処理<br>
                    パスワードを探すメールイベントエラー<br>
                    footer上にいくボタン<br>
                    コミュニティー地域化<br>
                    <li><b>2018年1月14日</b></li>
                    ID重複時のエラー修正<br>
                    <li><b>2018年1月17日</b></li>
                    ソフト削除された掲示物作成者の検索エラーを修正<br>
                </ul>
            </div>

            @else

            <div class="col" style='margin-top:40px'>
                <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>기술스택</b></h4>
                <div class="row text-center">
                    <div class="col">
                        <img src="{{asset("data/ProjectImages/master/WebSide.png")}}" alt="WebSideLog">

                        <br><b style="font-size:1.5rem;color:red">WebSide</b><br><hr>
                        <img src="{{ asset("data/ProjectImages/master/stack/html_css_js.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/jquery.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/ajax.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/bootstrap.png") }}" alt="WebSideLog" width="30%"><br>

                    </div>
                    <div class="col">
                        <img src="{{asset("data/ProjectImages/master/ServerSide.png")}}" alt="WebSideLog">

                        <br><b style="font-size:1.5rem;color:red">ServerSide</b><br><hr>
                        <img src="{{ asset("data/ProjectImages/master/stack/php.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/laravel.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/AWS.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/apache.png") }}" alt="WebSideLog" width="30%"><br>
                        </ul>
                    </div>
                    <div class="col">
                        <img src="{{asset("data/ProjectImages/master/DataBase.png")}}" alt="WebSideLog">

                        <br><b style="font-size:1.5rem;color:red">OS&DATABASE</b><br><hr>
                        <img src="{{ asset("data/ProjectImages/master/stack/ubuntu.png") }}" alt="WebSideLog" width="30%"><br>
                        <img src="{{ asset("data/ProjectImages/master/stack/mariadb.png") }}" alt="WebSideLog" width="30%"><br>

                    </div>
                </div>

                <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;margin-top:12%'><b>개발현황</b></h4>
                <br>
                2018년 10월 2일 ~ ing
                <br>
                <br>
                <ul style='margin-left:35px'>
                    <li><b>첫 개발시작 기본적인 화면설계</b></li>
                    -2018년10월4일 : 사이트 네비게이션 디자인 및 컨텐츠 구상<br>
                    -2018년10월5일 : 메인화면 레이아웃 설계<br>
                    -2018년10월9일 : 사이트 컨텐츠 및 데이터베이스 구상<br>
                    -2018년10월12일 : 소스코드 정리 및 주석작업<br><br>
                    <li><b>member기능 개발시작</b></li>
                    -2018년10월18일 : 회원가입 기능 구현 및 데이터베이스 생성<br>
                    -2018년10월20일 : 로그인 및 로그아웃 레이아웃 설계 및 구현<br>
                    -2018년10월22일 : 로그인 ID 중복검사,PW 정규표현식 도입<br>
                    -2018년10월22일 : 회원가입시 공백 방지 및 이메일중복 방지, 회원탈퇴기능 추가, 이메일로 ID찾기 및 비밀번호 재설정<br>
                    -2018년10월24일 : 회원 프로필 수정폼 및 기능 구현<br>
                    -2018년10월25일 : 글작성폼 (NaverEdtior) 적용 및 이메일 정규식 도입 <br><br>
                    <li><b>Community 개발시작</b></li>
                    -2018년10월 26일 : 데이터베이스 생성 및 레이아웃 설계<br>
                    -2018년10월 27일 : 게시판 제목 및 닉네임 길이 제한 , html문자 띄어쓰기 수정,국적별로 이미지 출력,CRUD기능<br>
                    -2018년10월 28일 : CKeditor교체,게시판 디자인 수정 및 페이지네이션<br>
                    <b style='color:red'>-2018년10월 29일 : PHP TermProject 중간발표</b><br>
                    -2018년11월 4일 : 검색기능 추가<br>
                    -2018년11월 5일 : 검색기능 페이지네이션 및 제목+내용 검색 추가<br>
                    -2018년11월 9일 : 게시글 댓글 기능 CRUD<br>
                    -2018년11월 10일 : 네이버 파파고API 도입<br>
                    -2018년11월 11일 : 추천 및 조회수 구현 <br><br>
                    <li><b>Laravel 프레임 워크 전환</b></li>
                    -2018년11월 12일 : 포럼 레이아웃 디자인,파파고 언어감지 기능 추가 <br>
                    <b style='color:red'>-2018년11월 14일 PHP->Laravel 프레임워크 전환 시작</b><br>
                    <img width="23%" src="{{asset("data/ProjectImages/master/umr2.png")}}" align="right" style="margin-right:8%">
                    -2018년11월 15일 레이아웃 및 라우트 설정<br>
                    -2018년11월 16일 회원가입 및 로그인 ORM 전환1<br>
                    -2018년11월 17일 회원가입 및 로그인 ORM 전환2<br>
                    -2018년11월 18일 게시판 CRUD ORM전환1<br>
                    -2018년11월 19일 게시판 CRUD ORM전환2<br>
                    -2018년11월 20일 게시판 CRUD ORM전환3<br>
                    -2018년11월 21일 게시판 CRUD ORM전환4<br>
                    -2018년11월 22일 게시판 CRUD ORM전환5<br>
                    <b style='color:red'>-2018년11월 25일 ~ 12월1일 현재 구현된 코드 대폭 수정</b><br>
                    -2018년12월 1일 회원가입시 메일 발송 추가<br>
                    -2018년12월 2일 google 사용자 인증 로그인 추가<br>
                    -2018년12월 9일 github 사용자 인증 로그인 추가 및 검색어 자동완성기능 도입 <br>
                    -2018년12월 11일 가입자 확인 메일 스케쥴 기능 추가<br>
                    <b style='color:red'>-2018년12월 12일 프로젝트 제출 (구현률 20%)</b><br><br>
                    <li><b>언어 지역화</b></li>
                    -2018년12월 17일 가입자 확인 메일 스케쥴 기능 추가<br>
                    -2018년1월 7일 컨트롤러 계층 구조화,우마루 컨트롤러<br>
                    -2018년1월 8일 footer Copyright<br>
                    -2018년1월 9일 한일 언어 지역화1<br>
                    -2018년1월 10일 한일 언어 지역화2<br>
                    -2018년1월 10일 한일 언어 지역화3<br>
                    -2018년1월 12일 만든사람들 페이지 추가<br>
                    -2018년1월 14일 프로젝트 모델 펙토리 추가<br><br>
                    <li><b>Notice 공지사항 추가</b></li>
                    -2018년1월 14일 공지사항 게시판 추가 및 파파고 번역 함수 모듈화,관리자 유저 추가<br>
                    -2018년1월 15일 Model 쿼리스코프Trait 및 회원 탈퇴 및 게시글 탈퇴시 여부 확인 추가 <br><br>
                    <li><b>버그 및 불편사항 게시판 추가</b></li>
                    -2018년1월 16일 불편사항 게시판 추가 및 관리자 기능 부여<br>
                    <b style='color:red'>-2018년1월 23일 AWS S3 파일업로드 기능 추가</b><br>
                    -2019년3월 18일 모델 계층화 및 Request클래스 유효성 검사 적용<br>
                    -2019년4월 10일 개발자 노트 페이지 추가<br>
                    -2019년4월 13일 일반회원과 소셜라이트 회원 유저프로필 정보 통합<br>
                    -2019년4월 26일 파일업로드 기능 trait전환<br>
                    <b style='color:red'>-2019년5월 11일 AWS RDS전환</b><br><br>
                    <li><b>펜팔 서비스 개발 시작</b></li>
                    -2019년5월 22일 데이터베이스 1차 설계<br>
                    -2019년5월 23일 펜팔페이지 설계<br>
                </ul>
            </div>
            <div class="w-100"></div>
            <div class="col" style='margin-top:40px'>
                <img width="23%" src="{{asset("data/ProjectImages/master/umr3.jpg")}}" align="right" style="margin-right:20%">
                <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>오류 수정일지</b></h4>
                <ul style='margin-left:35px'>
                    <li><b>2018년1월 11일</b></li>
                    프로필 상세보기 성별 지역화<br>
                    로그아웃시 지역화 세션 처리<br>
                    소셜라이트 처리<br>
                    메일 지역화<br>
                    로그아웃시 지역화 세션 처리<br>
                    로그인시 세션 처리<br>
                    비밀번호 찾기 메일 이벤트 에러<br>
                    footer위로 가기 버튼<br>
                    커뮤니티 지역화<br>
                    <li><b>2018년1월 14일</b></li>
                    아이디 중복시 오류 수정<br>
                    <li><b>2018년1월 17일</b></li>
                    소프트 삭제된 게시물 작성자 검색 에러 수정<br>
                </ul>
            </div>

            @endif
        </div>
    </div>
    @endsection
