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
            
            @if($penpalsCount  == 0)
            <div class="text-center" style="margin-top:15%">
                <img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/search.png")}}"
                    alt="Responsive image">

                    @if( $nickname )
                        <h3 style="margin-top:5%"><b style="color:blue">"{{ $nickname }}"</b>@lang('penpal/index.search_not_found')</h3>
                    @else
                        <h3 style="margin-top:5%">@lang('penpal/index.target_search_not_found')</h3>
                    @endif
                </div>
            @else
                @include('penpal.component.indexTable')
            @endif

            <div class="row timeline-pageBox">
                    <div class="col">

                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                            @if ($penpals->hasPages())
                                 {{ $penpals->onEachSide(5)->links() }} 
                            @endif 
                            
                    </div>

                </div>
        </div>
    </div>

</div>




@endsection
