@extends('layouts.app')
@section('title')
neitter
@endsection
@section('boards')
<link rel="stylesheet" href="{{asset('/css/penpal.css')}}">
@endsection
@section('content')
@include('penpal.component.menu')
<div class="container">
   
    <div class="row justify-content-center">

        @include('penpal.component.indexTable')

    </div>

</div>




@endsection
