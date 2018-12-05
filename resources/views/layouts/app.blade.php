<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- bootstrap4 --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- community.js --}}
    <script src="{{asset('/js/community.js')}}"></script>
    {{-- member.js --}}
    <script src="{{asset('/js/member.js')}}"></script>
    {{-- master.css --}}
    <link rel="stylesheet" href="{{asset('/css/master.css')}}">
    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{asset('data/icon/css/font-awesome.min.css')}}">
    <script src="{{asset('/data/ckeditor/ckeditor.js')}}"></script>
    
    {{-- member css --}}
    <link rel="stylesheet" href="{{asset('/css/member.css')}}">

    <title>@yield('title')</title>
</head>


<script>

    var exist = '{{Session::has('message')}}';    
    $(window).load(function()
    {
        if(exist){
            $('#Modal-small-demo').modal('show');
        }
        
    });
    </script>
<!-- 회원가입 이메일 -->
<div class="modal fade" id="Modal-small-demo" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset('data/ProjectImages/master/notice.png')}}" alt="notice">
                <h5 class="modal-title" id="Modal-small-demo-label"> 알림</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <b class="text-center">{{Session::get('message')}}</b>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>

@include('component.header')

<body>
    @yield('content')
</body>


@include('component.footer')

</html>
