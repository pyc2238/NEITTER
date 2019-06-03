@extends('layouts.app')
@section('title')
@lang('penpal/index.title')
@endsection
@section('penpal')
    <link rel="stylesheet" href="{{asset('/css/penpal/penpal.css')}}">
    <script src="{{ asset('/js/penpal/penpal.js') }}"></script>
@endsection
@section('content')

@include('penpal.component.menu')
<div class="container">

    <div class="row justify-content-center penpal-main-container">
        <div style="width:100%;">
                <div class="row">
                        <div class="col"></div>
                        <div class="col-10">
                            @include('penpal.component.indexMenu')
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                    @include('penpal.component.indexTools')
                            </div>
                            <div class="col"></div>
                        </div>
               
                  
            <hr>
            @if($penpalsCount == 0)
            <div class="text-center" style="margin-top:15%">
                <img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/search.png")}}"
                    alt="Responsive image">

                @if( $nickname )
                <h3 style="margin-top:5%"><b
                        style="color:blue">"{{ $nickname }}"</b>@lang('penpal/index.search_not_found')</h3>
                @else
                <h3 style="margin-top:5%">@lang('penpal/index.target_search_not_found')</h3>
                @endif
            </div>
            @else
                
                    <div class="row" id="penpal-list-box">
                        <div class="col"></div>
                        <div class="col"> 
                                @include('penpal.component.indexTableList')
                        </div>
                        <div class="col"></div>
                    </div>
                
                <div class="row" id="penpal-image-box" style="display:none">
                    <div class="col"></div>
                    <div class="col-10">
                        @include('penpal.component.indexImageList')            
                    </div>
                    <div class="col"></div>
                    
                </div>    
                
            @endif

            <div class="row penpal-pageBox">
                <div class="col">

                </div>
                <div class="col">

                </div>
                <div class="col">
                    @if ($penpals->hasPages())
                        {{ $penpals->appends(['list'=>$list,'page'=>$page])->onEachSide(5)->links() }}
                    @endif

                </div>

            </div>
        </div>
    </div>

</div>

@endsection
