@extends('layouts.app')
@section('title')
비밀번호 찾기
@endsection
@section('content')
<div class="container content">

    <div class="container">
        <br>
        <h3><b>NEITTER-비밀번호 찾기</b></h3>
        <hr>
        <div class="row find_div">
            <div class="col-sm"></div>
            <!--첫번 째 그리드 박스-->
            <div class="col-sm" style="padding-top:4%">
                @include('component.siteImage')

                <script language="javascript">
                    var R=Math.floor(Math.random()*17);
                show_Banner(R);
            </script>
                <form action="{{route('user.reset')}}" class='form-group find_form' method="post">
                    @csrf
                    <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your email</h1>
                    <i class="fa fa-envelope"><label for="inputPassword">이메일</label></i>
                    <input type="email" id="email" name="email" class="form-control" autocomplete=off required>

                    <div class='text-center checkBtn'>
                        <button class="btn btn-outline-warning" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;확인&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </form>
                <!--end of form-->

            </div>
            <!--두번쨰 그리드 박스-->

            <div class="col-sm">

            </div>
            <!--세번째 그리드 박스-->
        </div>
        <!--end of row-->
    </div>
</div>
@endsection
