@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

<div style="height:900px">
    준비중

</div>
                    {{-- 
                    <a href="#" onclick="showTitle()" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/umr1.png")}}"
                            alt="Responsive image"></a>
                    <a href="#" onclick="showTitle()" onfocus="this.blur();"><img id=Rand_Banner class="img-fluid" src="{{asset("data/ProjectImages/master/logoImage/umr2.png")}}"
                            alt="Responsive image"></a> --}}

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var socialite = '{{Session::has('socialiteLogin')}}'    
            $(window).load(function()
            {
                if(socialite){
                    $('#Modal-small').modal('show');
                }
                
            });
            </script>
<!-- 회원가입 이메일 -->

<div class="modal fade" id="Modal-small" tabindex="-1" role="dialog" aria-labelledby="Modal-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-small">회원가입이 완료되었습니다!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <img width="100%" src="{{asset("data/ProjectImages/master/logoImage/registered.gif")}}" alt="회원가입 성공">
            </div>
            <b class="text-center"> <a href="{{url('introduction')}}">사이트소개 바로가기</a></b>
            <br>
            <p class="text-center"><a href="{{route('socialite.userInfo')}}">내정보</a>로가서 회원정보를 수정해보세요!</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>

@endsection
