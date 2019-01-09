@extends('layouts.app')
@section('title')
@lang('auth/change_Password_Form.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>@lang('auth/change_Password_Form.subject')</b></h3>
    <hr>
    <div class="row changePw_form">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.updatePassword',Auth::user()->id)}}" method="post">
                @csrf
                @method('put')
                <label for="inputPassword">@lang('auth/change_Password_Form.password')</label>
                <input type="password" id="inputPassword" name="password" class="form-control" autocomplete=off
                    required>
                <br>
                <br>
                <label for="inputPassword">@lang('auth/change_Password_Form.new_password')</label>
                <input type="password" id="inputPassword" name="new_password" class="form-control" autocomplete=off
                    required>
                <small style="color:red">@lang('auth/change_Password_Form.notice')</small>
                <br>
                <br>
                <label for="inputPassword">@lang('auth/change_Password_Form.new_password_check')</label>
                <input type="password" id="inputPassword" name="new_password_check" class="form-control" autocomplete=off
                    required>

                <div id="profileCheckBox">
                    <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;@lang('auth/change_Password_Form.check')&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
