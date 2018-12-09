@extends('layouts.app')
@section('title')
로그인
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-로그인</b></h3>
    <hr>

    <div class="row" style="margin-top:7%;">
        <div class="col-sm"></div>
        <!--첫번 째 그리드 박스-->
        <div class="col-sm">
            <div class="container">

                @include('component.siteImage')

                <script language="javascript">
                    var R=Math.floor(Math.random()*17);
                        show_Banner(R);
                </script>

                <form action="{{route('login')}}" method="POST">
                    @csrf

                    <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
            </div>
            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                value="{{ old('email') }}" autocomplete=off placeholder="Email" required autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
            <br>

            <label for="password" class="sr-only">Password</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password" placeholder="Password" required>

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif

            <br>

            <div class="text-center">
                <button class="btn btn-outline-warning " type="submit">&nbsp;&nbsp;&nbsp;로그인&nbsp;&nbsp;&nbsp;</button>
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{ route('register') }}'">&nbsp;&nbsp;회원가입&nbsp;&nbsp;</button>
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{ route('password.request') }}'">ID/PW찾기</button>
            </div>

            </form>
        </div>
        <!--두번쨰 그리드 박스-->

        <div class="col-sm"></div>
        <!--세번째 그리드 박스-->
    </div>

    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm text-center" style="margin-top:3%;margin-bottom:5%">
            <!-- Add font awesome icons -->
            <a href="{{ url('socialauth/github') }}" class="fa fa-github Social" title="github"></a>
        <a href="{{ url('socialauth/twitter') }}" class="fa fa-twitter Social" title="twitter"></a>
        <a href="{{ url('socialauth/google') }}" class="fa fa-google Social" title="google"></a>
            <a href="#" class="fa fa-question Social" title="yahoo"></a>
        </div>
        <div class="col-sm"></div>
    </div>
</div>


<script>
    var registered = '{{Session::has('result')}}'    
$(window).load(function()
{
    if(registered){
        $('#Modal-small').modal('show');
    }
    
});
</script>
<!-- 회원가입 이메일 -->
<div class="modal fade" id="Modal-small" tabindex="-1" role="dialog" aria-labelledby="Modal-small"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-small">회원가입이 완료되었습니다!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <img width="100%" src="https://1.bp.blogspot.com/-4wFqJEBc_8o/WhYrKpjHUEI/AAAAAAAKPE4/aRPRv_-MYrowlgVT7r_8H1URKzXjvCuawCLcBGAs/s1600/AS003339_05.gif" alt="회원가입 성공">
            </div>
            <b class="text-center"> <a href="{{url('introduction')}}">사이트소개 바로가기</a></b>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>

@endsection
