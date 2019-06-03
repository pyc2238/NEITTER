@extends('layouts.app')
@section('title')  
    친구들    
@endsection
@section('penpal')
<link rel="stylesheet" href="{{asset('/css/penpal/penpal.css')}}">
<link rel="stylesheet" href="{{ asset('/css/penpal/timeline.css') }}">
<script src="{{ asset('/js/penpal/penpal.js') }}"></script>
<script src="{{ asset('/js/penpal/timeline.js') }}"></script>

@endsection
@section('content')

@include('penpal.component.menu')
<div class="container">

    <div class="row justify-content-center penpal-show-container">
            <div class="col" >
                <div class="col">
                    <b style="font-size:1.444rem">{{ $friend->user->name }}</b>
                    @if($friend->user->country == 'ko')
                        <span><img style="padding-left:10px;" src="{{ asset("data/ProjectImages/penpal/korea.png") }}" alt="men"></span>
                    @else
                        <span><img style="padding-left:10px;" src="{{ asset("data/ProjectImages/penpal/japan.png") }}" alt="women"></span>
                    @endif
                    @if($friend->user->gender == 'men')
                        <span><img style="width:15px" src="{{ asset("data/ProjectImages/master/men.png") }}" alt="men"></span>
                    @else
                        <span><img style="width:15px" src="{{ asset("data/ProjectImages/master/women.png") }}" alt="women"></span>
                    @endif

                   <span>{{ $friend->user->age  }}</span>
                   <span class="float-right" style="font-size:1.25rem">
                       {{ $friend->created_at  }}
                   </span>

                </div>
                <hr>
                @include('penpal.component.showIntroBox')
                @include('penpal.component.showTools')
                @include('penpal.component.showTimeline')
            </div>
       
    </div>

</div>

@endsection
