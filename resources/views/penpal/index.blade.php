@extends('layouts.app')
@section('title')
@lang('penpal/index.title')
@endsection
@section('penpal')
<link rel="stylesheet" href="{{asset('/css/penpal.css')}}">
@endsection
@section('content')

@include('penpal.component.menu')
<div class="container">
   
    <div class="row justify-content-center penpal-main-container">
        <div style="width:100%;">
            @include('penpal.component.indexMenu')
            @include('penpal.component.indexTools')
            <br>
            @include('penpal.component.indexTable')

            <div class="row timeline-pageBox">
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                            {{ $penpals->onEachSide(5)->links() }}
                    </div>

                </div>
        </div>
    </div>

</div>




@endsection
