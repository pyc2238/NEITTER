@extends('layouts.app')
@section('title')
비밀번호 변경
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-회원 비밀번호 확인</b></h3>
    <hr>
    <div class="row changePw_form">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.updatePassword',Auth::user()->id)}}" method="post">
                @csrf
                @method('put')
                <label for="inputPassword">현재 비밀번호</label>
                <input type="password" id="inputPassword" name="password" class="form-control" autocomplete=off
                    required>
                <br>
                <br>
                <label for="inputPassword">새 비밀번호</label>
                <input type="password" id="inputPassword" name="new_password" class="form-control" autocomplete=off
                    required>
                <small style="color:red">8~15자,영문,숫자,특수문자가 들어가야 합니다.</small>
                <br>
                <br>
                <label for="inputPassword">새 비밀번호 확인</label>
                <input type="password" id="inputPassword" name="new_password_check" class="form-control" autocomplete=off
                    required>

                <div id="profileCheckBox">
                    <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;확인&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </form>
            <!--end of form-->

        </div>
        <!--두번쨰 그리드 박스-->

        <div class="col-sm"></div>
        <!--세번째 그리드 박스-->
    </div>
    <!--end of row-->
</div>
@endsection
