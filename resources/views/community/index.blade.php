@extends('layouts.app')
@section('title')
@lang('community/index.title')
@endsection
@section('boards')
<script src="{{asset('/js/boards.js')}}"></script>
<link rel="stylesheet" href="{{asset('/css/community.css')}}">
@endsection
@section('content')


<div class="container content">


    <br>
    <h3><b>@lang('community/index.subject')</b></h3>
    <hr>

    @include('community.component.hotmsgs')

    <div class="row">

        <div class='col'>
            <button class='createBtn float-left'
                onclick="location.href='{{ route('community.create',['search'=>$search,'where'=>$where,'page'=>$page]) }}'"
                }}' title="create" style="background-color: #1c4176;"><i class="fa fa-pencil"
                    style="width:50px;color:white"></i></button>
            <button class='reloadBtn float-left' onclick="window.location.reload()" title="reload"
                style="background-color: #1c4176;"><i class="fa fa-retweet" style="width:50px;color:white"></i></button>

        </div>
        <div class='col'>
            <h5 style="font:bold; display:inline-block;" class='float-right'><i class="fa fa-calculator ">TOTAL :
                    {{$count}}</i></h5>
        </div>

        <div class="container" style="height:95vh">

            @if($count == 0)
            <div class="text-center" style="margin-top:15%">
                <img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/search.png")}}"
                    alt="Responsive image">

                <h1 style="margin-top:5%"><b style="color:blue">"{{$search}}"</b>@lang('community/index.search_result')
                </h1>
            </div>
            @else
            @include('community.component.indexTable')
            @endif
        </div>

        @include('community.component.indexTools')

    </div>

</div>
@endsection
