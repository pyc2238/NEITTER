@extends('layouts.app')
@section('title')
@lang('home/main.title')
@endsection
@section('content')
<div class="container mainPage">
    <div class="row justify-content-center">
        <div class="col">
                @include('home.component.main.penpalCountBoard')
        </div>
        <div class="col-7">
                @include('home.component.main.slider')
                @include('home.component.main.newFriends')
                @include('home.component.main.boards')
            
        </div>
    </div>
</div>


<script>
    var socialite = '{{Session::has(' socialiteLogin ')}}'
    $(window).load(function () {
        if (socialite) {
            $('#Modal-small').modal('show');
        }
    });

</script>
<!-- 회원가입 이메일 -->

@include('home.component.welcomeModel')

@endsection
