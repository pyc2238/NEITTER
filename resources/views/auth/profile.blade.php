@extends('layouts.app')
@section('title')
회원 프로필
@endsection
@section('content')

<br>
<h3>NEITTER-회원 정보 수정</h3>
<hr>

<div class="row" style='margin-bottom:4%;margin-top:8%margin-bottom:8%;'>
    <div class="col-sm"> </div>
    <!--첫번째 그리드 박스-->
    <div class="col-sm">

    <form action="{{route('update')}}" method="post" style="margin-top:8%;margin-bottom:8%">
            @method('PUT')
            @csrf
            <label for="inputEmail">이메일</label>
            <input style="color:blue;" type="email" name="email" class="form-control" autocomplete=off value="{{Auth::user()->email}}"
                readonly>
            <!--autocomplete 자동완성기능 off , autofocus , required-->
            <br>
            <br>
            <br>
            비밀번호 <a href="{{route('ChangePasswordFrom',Auth::user()->id)}}"><b>[ 비밀번호 변경 ]</b></a>
            <br>
            <br>
            <br>
            <i class="fa fa-exclamation-circle"><label for="inputNickname">닉네임</label></i>
            <input style="color:blue;" type="text" name="name" class="form-control" value="{{Auth::user()->name}}"
                readonly>
            <br>
            <br>
            <br>
            <div class="form-group">
                <label for="comment">자기소개</label>
                <textarea class="form-control" rows="5" style="resize: none;" name="selfContext" autocomplete=off>{{Auth::user()->selfContext}}</textarea>
            </div>

            <br>
            <br>
            <br>
            <div id="joinBtnBox">
                <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">수정</i></button>
            <button class="btn btn-outline-warning " type="button" onclick="location.href ='{{route('destroy')}}'"><i class="fa fa-trash">회원탈퇴</i></button>
            </div>
        </form>
    </div>


    <div class="col-sm"></div>


</div>


@endsection
