@extends('layouts.app')
@section('title')
@lang('auth/reset.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>@lang('auth/reset.subject')</b></h3>
    <hr>
    <div class="row find_div">
        <div class="col-sm">

            <div class='text-center' style='margin-top:12%'>
                <hr>
                <h1><i class="fa fa-address-card"></i>@lang('auth/reset.notice')</h1>
                <hr>
            </div>

            <div class='text-center' style="margin-top:11%">
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{route('home.index')}}'">&nbsp;&nbsp;&nbsp;&nbsp;@lang('auth/reset.goHome')&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>
        </div>
        <!--그리드 박스-->
    </div>
    <!--end of row-->
</div>
@endsection
