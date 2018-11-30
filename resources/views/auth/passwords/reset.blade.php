@extends('layouts.app')
@section('title')
비밀번호 변경
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-회원 비밀번호 찾기 결과</b></h3>
    <hr>
    <div class="row find_div">
        <div class="col-sm">

            <div class='text-center' style='margin-top:12%'>
                <hr>
                <h1><i class="fa fa-address-card"></i>확인된 회원님의 이메일을 확인하시기 바랍니다. </h1>
                <hr>
            </div>

            <div class='text-center' style="margin-top:11%">
                <button class="btn btn-outline-warning" type="button" onclick="location.href='{{url('/')}}'">&nbsp;&nbsp;&nbsp;&nbsp;홈으로&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>
        </div>
        <!--그리드 박스-->
    </div>
    <!--end of row-->
</div>
@endsection
