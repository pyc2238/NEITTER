@extends('layouts.app')
@section('title')
게시판
@endsection

@section('content')
<div class="container content">
    <link rel="stylesheet" href="{{asset('/css/community.css')}}">

    <br>
    <h3><b>NEITTER-지식교류</b></h3>
    <hr>

    <div class="row">
        <div class='col'>
            <h5 style="font:bold; display:inline-block;" class='float-right'><i class="fa fa-calculator ">TOTAL :
                    {{$count}}</i></h5>
        </div>

        <div class="container" style="height:95vh">
            @if($count == 0)
            <div class="text-center" style="margin-top:15%">
                @include('component.siteImage')

                <script language="javascript">
                    var R = Math.floor(Math.random() * 16);
                    show_Banner(R);

                </script>
                <h1 style="margin-top:5%"><b style="color:blue">"{{$search}}"</b>라는 검색 결과가 존재하지 않습니다.</h1>
            </div>
            @else
            @include('community.component.indexTable')
            @endif
        </div>

        @include('community.component.indexTools')

    </div>

</div>
@endsection
