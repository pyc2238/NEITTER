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
                    <a class="nav-link text-uppercase" href="{{ route('penpal.index') }}">@lang('home/header.penpal')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{route('community.index')}}">@lang('home/header.community')</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-uppercase" href="{{route('forum.index')}}">@lang('home/header.forum')</a>
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
        @if(Auth::check())
            <a  data-toggle="modal" data-target="#Modal-translation" title="translation"><i class="fa fa-exchange" id="translation"></i> </a>
        @endif
        <a href="{{ route('notice.index') }}" title="notice"><i class="fa fa-bullhorn" id="bullhorn"></i></a>
    </div>



    @if(Auth::check())
    @if(Auth::user()->admin == 1)
    <div class="userInfo">
        <a href=""><i class="fa fa-audio-description" style="">{{Auth::user()->name}}
            </i></a>
        <a href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
            class=""><i class="fa fa-sign-out">@lang('home/header.logout')</i></a>
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
        <a id="inboxBtn" onclick="openInbox()"><i class="fa fa-envelope">@lang('home/header.mailbox')
             <span class="badge" id="mailCount" title=""></span></i>
            </a>
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

@include('home.component.translationModal')



<script>
    function openInbox(){  
        window.open('{{ route('mail.inbox') }}',
         "inbox",
         "width=710, height=665, toolbar=no, menubar=no, scrollbars=no, resizable=yes"
         );  
    }
    
    if({!! Auth::check() !!}){
        $(function () {
        $.ajax({
            url: '{{route('mail.count')}}',
            type: 'get',
            data: {_token: "{{ csrf_token() }}",
                
                },
            success: function (data) {
                if(data > 0){
                    $('#mailCount').css('background-color','red').css('color','white');
                }
                $('#mailCount').text(data);
                $('#my_mailCount').text(data);
                $('#mailCount').attr('title','@lang('home/header.mailCount1') '+data+' @lang('home/header.mailCount2')');
                console.log('ok');
                
            }, error: function () {
                alert("error!!!!");
            }
        });
    });    
    }
    
    
</script>

