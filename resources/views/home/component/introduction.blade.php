@extends('layouts.app')
@section('title')
@lang('home/component/introduction.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/22.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/introduction.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>プロジェクト概要</b></h4>
            <br>

            <p><b>NEITTER&nbsp;:&nbsp;&nbsp;&nbsp;neighbor+letter 隣国の人とのペンパル</b></p>

            <p>NEITTEERは2018年10月2日,初めて開発した韓日文通サイトで日韓両国一人ひとりの文化的交流を通じて政治的,歴史的問題と関連した韓日関係の困難において民間
                <img width="16%" src="{{asset("data/ProjectImages/master/logoImage/17.png")}}" align="right">
                レベルの交流をはじめ,日韓間の国家交流の発展にも小さな力になれるようにしようという主旨に開発されました。</p>

            <p>韓国に対して感情的に接する人もいるでしょうが,このような民間レベルの交流を通じて,韓国人日本人との個人的な交流において,政治的,歴史的問題が必要でしょうか？
                いいえ.　これは国家と国家の交流よりは人間と人間との交流であることを強調したいです.</p>

            <p> "寝巻き姿で隣の家の友達とパソコンでチャットでもするように手紙を書いた。"こうした個々人の文化交流がNEITTEERの追求する交流です。</p>

            <p>NEITTEERはインターネット上で発生する全ての日韓間の民間交流を支援します。 あわせて韓国,日本国内のオフライン会合を通じて情報交換及び語学的関心事を持った会員間の語学会などを支援し
                育成させます。</p>
        </div>

        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>開発現況</b></h4>
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
                -2018年1月9日: 韓日言語の地域化1<br>
                -2018年1月10日: 韓日言語の地域化2<br>
                -2018年1月10日: 韓日言語の地域化3<br>
                -2018年1月12日: クリエーターページを追加<br>
                -2018年1月14日: プロジェクトモデルペクトリーを追加<br><br>
                <li><b>Notice お知らせ掲示板を追加</b></li>
                -2018年1月14日: お知らせ掲示板を追加及びパパゴ翻訳関数モジュール化,アドミンユーザー追加<br>
                -2018年1月15日,ModelクエリスコフTrait,会員脱退および掲示文脱退時の実行可否確認を追加<br>
                <b style='color:red'>-2018年1月23日 AWS S3 ファイルアップロード機能を追加</b><br>

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

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>프로젝트 개요</b></h4>
            <br>

            <p><b>NEITTER&nbsp;:&nbsp;&nbsp;&nbsp;neighbor+letter 이웃나라 사람과의 펜팔</b></p>

            <p>NEITTER는 2018년 10월 2일 처음 개발한 한일 펜팔사이트로 한일간 개개인의 문화적 교류를 통하여 정치적,역사적문제로 얽힌 한일관계의 어려움에 있어 민간
                <img width="16%" src="{{asset("data/ProjectImages/master/logoImage/17.png")}}" align="right">
                차원의 교류를 시작으로, 한일간 국가적 교류의 발전에도 작은 보탬이 될수 있게 하자는 취지에 개발 되었습니다.</p>

            <p>일본에 혹은 한국에 대해 감정적으로 대하는 사람도 있겠지만 이러한 민간차원의 교류를 통한 한국인 일본인과의 개인적인 교류에서 정치적, 역사적 문제가 필요할까요?
                아닙니다. 이것은 국가와 국가의 교류 보다는 인간과 인간과의 교류임을 강조하고 싶습니다.</p>

            <p> "잠옷차림으로 옆집 친구와 컴퓨터를 마주놓고 채팅을 하듯 편지를쓰듯.."이러한 개개인의 문화교류가 NEITTER의 추구하는 교류입니다.</p>

            <p>NEITTER은 인터넷상에서 발생하는 모든 한일간 민간교류를 지원합니다. 아울러 한국, 일본내의 오프라인 모임을 통하여 정보교환 및 어학적관심사를 가진 회원간의 어학 모임등을 지원하고
                육성시킵니다.</p>
        </div>


        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>개발현황</b></h4>
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
                <li><b>버그 및 불편사항  게시판 추가</b></li>
                -2018년1월 16일 불편사항 게시판 추가 및 관리자 기능 부여<br>
                <b style='color:red'>-2018년1월 23일 AWS S3 파일업로드 기능 추가</b><br>
                
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
