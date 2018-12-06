<nav class="navbar navbar-expand-lg navbar-light bg-danger text-light py-3 main-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset("data/ProjectImages/master/NEITTER.png")}}" alt="Logo"
                ondragstart="return false"></a>
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
                    <a class="nav-link text-uppercase" href="{{route('community.index')}}">community</a>
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
        <a href="{{ url('/') }}"><i class="fa fa-home" id="home" ></i> </a>
        <a href="#"><i class="fa fa-search" id="search" ></i> </a>
    </div>


    @if(Auth::check())
    <div class="userInfo">
        <a href="#"><i class="fa fa-user">{{Auth::user()->name}}
            </i></a>
        <a href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            class=""><i class="fa fa-sign-out">로그아웃</i></a>
        <a href="{{route('user.check')}}"><i class="fa fa-cogs">내정보</i></a>
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









 

 

 
 

 
 
