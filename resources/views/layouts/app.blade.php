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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


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
    var msg = '{{Session::get('message')}}';
            var exist = '{{Session::has('message')}}';
            if(exist){alert(msg);}
</script>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-danger text-light py-3 main-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset("data/ProjectImages/master/NEITTER.png")}}"
                    alt="Logo" ondragstart="return false"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-uppercase" href="index.html">Penpal <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="">community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="/TermProject/forum/forum.php">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="#works">Club</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="#people-say">ALBUM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-uppercase" href="#contact">contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class=" headcontainer">
        <div class="home">
            <a href="{{ url('/') }}"><img id="homeImg" src="{{asset('data/ProjectImages/master/home.png')}}" alt="homeLogo"
                    ondragstart="return false"></a>
        </div>


        @if(Auth::check())
        <div class="userInfo">
            <a><i class="fa fa-user">{{Auth::user()->name}}
                </i></a>
            <a href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                class=""><i class="fa fa-sign-out">로그아웃</i></a>
            <a href="{{route('CheckUser')}}"><i class="fa fa-cogs">내정보</i></a>
            <a href=""><i class="fa fa-envelope">쪽지</i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @else
        <div class="userInfo">
            <a href="{{ route('login') }}"><i class="fa fa-check">로그인</i></a>

            <a href="{{ route('register') }}"><i class="fa fa-address-card">회원가입</i></a>

            <a href="{{ route('password.request') }}"><i class="fa fa-question-circle">비밀번호 찾기/변경</i></a>
        </div>
        @endif
    </div>



    <main class="container content">
        @yield('content')
    </main>
    </div>
</body>


<footer class="footer" style='margin-top:1%;height:5vh'>
    <a href="{{url('introduction')}}">소개</a>
</footer>

</html>
