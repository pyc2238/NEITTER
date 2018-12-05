@extends('layouts.app')
@section('title')
회원 아이디 확인
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-회원 비밀번호 확인</b></h3>
    <hr>
    <div class="row profile_form">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.info',Auth::user()->id)}}" method="post">
                @csrf
                <b>회원이메일</b><b style="color:blue;">
                    {{Auth::user()->email}}</b>
                <br>
                <br>
                <br>
                <label for="inputPassword">비밀번호</label>
                <input type="password" id="password" name="password" class="form-control" autocomplete=off placeholder="Password"
                    required>
                <i class="fa fa-exclamation-circle"><small>회원님의 정보를 보호하기 위해 확인합니다. </small></i>

                <div id="profileCheckBox">
                    <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;확인&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </form>
            <!--end of form-->

        </div>
        <!--두번쨰 그리드 박스-->

        <div class="col-sm">
            <div class="col-sm">
                <div id="checkIdbox">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlInline" name="find_check_id"
                            value="1" onClick="findCheckId(this);">
                        <label class="custom-control-label" for="customControlInline"><b style="color:blue;" onClick="findCheckId(this);">소셜로그인</b></label>
                    </div>
                </div>
                <!--end of checkIdbox-->
            </div>

        </div>
        <!--세번째 그리드 박스-->

    </div>
    <!--end of row-->
</div>
@endsection
