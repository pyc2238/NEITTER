@extends('layouts.app')
@section('title')
@lang('home/component/creator.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <div class="row">
        <div class="col">
            <img src="{{asset("data/ProjectImages/master/logoImage/6.png")}}" width="72" alt="thumbnail">
            <h2 style='display:inline-block;'>@lang('home/component/creator.subject')</h2>
            <hr>
        </div>
        <div class="w-100"></div>

        @if(Session::get('locale') == 'ja')
        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>サイト総則</b></h4>
            <br>

            
        </div>

        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>サービス利用</b></h4>

            <br>
            <br>
            
        </div>
        @else

        <div class="col" style='margin-top:40px'>

            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>사이트 총칙</b></h4>
            <br>

            
        </div>

        <div class="w-100"></div>
        <div class="col" style='margin-top:40px'>
            <h4 style='color:blue;font-family: "Nanum Gothic", sans-serif;'><b>서비스 이용</b></h4>

            
        </div>
        @endif
    </div>
</div>
@endsection
