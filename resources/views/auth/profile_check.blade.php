@extends('layouts.app')
@section('title')
    @lang('auth/profile_check.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>@lang('auth/profile_check.subject')</b></h3>
    <hr>
    <div class="row profile_form">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.info',Auth::user()->id)}}" method="post">
                @csrf

                @if(Auth::user()->email)
                <b>@lang('auth/profile_check.user_email')</b><b style="color:blue;">
                    {{Auth::user()->email}}</b>
                @endif
                @unless(Auth::user()->email)
                <b>@lang('auth/profile_check.user_nickname')</b><b style="color:blue;">
                    {{Auth::user()->name}}</b>
                @endunless
                <br>
                <br>
                <br>
                <label for="inputPassword">@lang('auth/profile_check.password')</label>
                <input type="password" id="password" name="password" class="form-control" autocomplete=off placeholder="Password"
                    required>
                <i class="fa fa-exclamation-circle"><small>@lang('auth/profile_check.notice')</small></i>

                <div id="profileCheckBox">
                    <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;@lang('auth/profile_check.check')&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
                        <label class="custom-control-label" for="customControlInline"><b style="color:blue;" onClick="findCheckId(this);">@lang('auth/profile_check.social')</b></label>
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
