<nav class="navbar navbar-expand-lg navbar-light bg-danger text-light py-3 main-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}"><img src="{{asset("data/ProjectImages/master/NEITTER.png")}}"
                alt="Logo" ondragstart="return false"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-uppercase" href="index.html">@lang('home/header.penpal')<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{route('community.index')}}">@lang('home/header.community')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="/TermProject/forum/forum.php">@lang('home/header.forum')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="#works">@lang('home/header.club')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="#people-say">@lang('home/header.album')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-uppercase" href="#contact">@lang('home/header.contact')</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class=" headcontainer">
    <div class="home">
        <a href="{{ route('home.index') }}" title="home"><i class="fa fa-home" id="home"></i> </a>
        <a href="#" title="search"><i class="fa fa-search" id="search"></i> </a>
        <a href="#" title="notice"><i class="fa fa-bullhorn" id="bullhorn"></i></a>
    </div>



    @if(Auth::check())
    @if(Auth::user()->admin == 1)
    <div class="userInfo">
        <a href=""><i class="fa fa-audio-description" style="">{{Auth::user()->name}}
            </i></a>
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
            class=""><i class="fa fa-sign-out">>@lang('home/header.logout')</i></a>
        <a href=""><i class="fa fa-database">관리</i></a>
        <a href=""><i class="fa fa-cog">설정</i></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    @else
    <div class="userInfo">
        <a href=""><i class="fa fa-user">{{Auth::user()->name}}</b>
            </i></a>
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
            class=""><i class="fa fa-sign-out">@lang('home/header.logout')</i></a>
        <a href="{{route('user.check')}}"><i class="fa fa-cogs">@lang('home/header.profile')</i></a>
        <a href=""><i class="fa fa-envelope">@lang('home/header.mailbox')</i></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    @endif
    @endif
    @unless(Auth::check())
    <div class="userInfo">
        <a href="{{ route('login') }}"><i class="fa fa-check">@lang('home/header.login')</i></a>

        <a href="{{ route('register') }}"><i class="fa fa-address-card">@lang('home/header.register')</i></a>

        <a href="{{ route('password.request') }}"><i class="fa fa-question-circle">@lang('home/header.modify')</i></a>
    </div>
    @endunless
</div>
