@extends('layouts.app')
@section('title')
        @lang('inquiry/show.title')
@endsection
@section('boards')
<script src="{{asset('/js/boards.js')}}"></script>
<link rel="stylesheet" href="{{asset('/css/community.css')}}">
@endsection
@section('content')


<a id="MOVE_TOP_BTN" href="#"><img src="{{asset('/data/ProjectImages/community/top.png')}}" alt="back-to-top"></a>
<a id="MOVE_COMMENT_BTN" href="#tool" onclick='fnMove()'><img src="{{asset('/data/ProjectImages/community/edit.png')}}"
        alt="back-to-comment"></a>

@include('inquiry.component.showTable')
@include('inquiry.component.showTools')
@include('inquiry.component.showComment')


@endsection
