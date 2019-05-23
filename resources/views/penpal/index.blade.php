@extends('layouts.app')
@section('title')
neitter
@endsection
@section('boards')
<link rel="stylesheet" href="{{asset('/css/penpal.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('penpal.component.menu')
        @include('penpal.component.indexTable')

    </div>

</div>




@endsection
