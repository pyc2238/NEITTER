<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    {{-- - 웹브라우저의 화면을 각 디바이스에 최적화 된 크기로 표현해준다. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- bootstrap4 --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    {{-- boards js/css --}}
    @yield('boards')
    {{-- penpal js/css --}}
    @yield('penpal')

    {{-- main_slider js/css --}}
    @yield('main_slider')

    {{-- member.js --}}
    <script src="{{asset('/js/member.js')}}"></script>

    {{-- home.js --}}
    <script src="{{ asset('/js/home.js') }}"></script>
    
    {{-- home.css --}}
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    

    {{-- master.css --}}
    <link rel="stylesheet" href="{{asset('/css/master.css')}}">

    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{ asset('data/icon/css/font-awesome.min.css') }}">

    {{-- ckeditor --}}
    @yield('ckeditor')


    {{-- member css --}}
    <link rel="stylesheet" href="{{asset('/css/member.css')}}">

    @yield("umr")

    <title>
        @yield('title')
    </title>
    {{-- @yield('search') --}}

</head>

<script>
    var exist = '{{Session::has('message')}}';
    $(window).load(function () {
        if (exist) {
            $('#Modal-small-demo').modal('show');
        }

    });

</script>


@include('component.noticeModal')
@include('home.component.header')

<body>
  
    @yield('content')

</body>


@include('home.component.footer')

{{-- <script type="text/javascript">
    $(window).load(function () {
        $('#loading').hide();
    });

</script>

<div id="loading"><img id="loading-image" src="{{ asset('data/ProjectImages/master/loading.gif') }}" alt="Loading..." /> --}}
{{-- </div> --}}


</html>
