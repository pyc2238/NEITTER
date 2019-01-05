@extends('layouts.app')
@section('title')
소개
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/22.png")}}"
                width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>NEITTER 소개</h2>
            <hr>
        </div>
        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>프로젝트 개요</b></h4>
            <br>

            <p><b>NEITTER&nbsp;:&nbsp;&nbsp;&nbsp;neighbor+letter 이웃나라 사람과의 펜팔</b></p>

            <p>NEITTER는 2018년 10월 2일 처음 개발한 한일 펜팔사이트로 한일간 개개인의 문화적 교류를 통하여 정치적,역사적문제로 얽힌 한일관계의 어려움에 있어 민간
                <img width="16%" src="{{asset("data/ProjectImages/master/logoImage/17.png")}}"
                    align="right">
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
                <b style='color:red'>-2018년12월 12일 프로젝트 제출 (구현률 20%)</b><br><br>
                <li><b>Forum개발 시작</b></li>
                
            </ul>
        </div>
    </div>
</div>
@endsection
