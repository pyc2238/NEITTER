@extends('layouts.app')
@section('title')
@lang('inquiry/index.title')
@endsection
@section('inquiryJsCss')
<script src="{{asset('/js/inquiry.js')}}"></script>
<link rel="stylesheet" href="{{asset('/css/community.css')}}">
@endsection
@section('content')
<div class="container content">


    <br>
    <h3><b>@lang('inquiry/index.subject')</b></h3>
    <hr>

    <div class="row">
        <div class='col'>
            <h5 style="font:bold; display:inline-block;" class='float-right'><i class="fa fa-calculator ">TOTAL :
                    {{$count}}</i></h5>
        </div>
        <div class="container" style="height:95vh">
            @if($count == 0)
            <div class="text-center" style="margin-top:15%">
                <img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/search.png")}}"
                    alt="Responsive image">

                <h1 style="margin-top:5%"><b style="color:blue">"{{$search}}"</b>@lang('inquiry/index.search_result')</h1>
            </div>
            @else
            @include('inquiry.component.indexTable')
            @endif
        </div>

        @include('inquiry.component.indexTools')

    </div>

</div>
@endsection
