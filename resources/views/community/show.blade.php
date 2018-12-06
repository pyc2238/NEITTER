@extends('layouts.app')
@section('title')
게시글
@endsection
@section('content')


<link rel="stylesheet" href="{{asset('/css/community.css')}}">


<a id="MOVE_TOP_BTN" href="#"><img src="{{asset('/data/ProjectImages/community/top.png')}}" alt="back-to-top"></a>
<a id="MOVE_COMMENT_BTN" href="#tool" onclick='fnMove()'><img src="{{asset('/data/ProjectImages/community/edit.png')}}"
        alt="back-to-comment"></a>

@include('community.component.showTable')
@include('community.component.showTools')
@include('community.component.showComment')


@endsection
