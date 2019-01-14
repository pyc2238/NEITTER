@extends('layouts.app')
@section('title')
neitter
@endsection
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

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var socialite = '{{Session::has('
    socialiteLogin ')}}'
    $(window).load(function () {
        if (socialite) {
            $('#Modal-small').modal('show');
        }

    });

</script>
<!-- 회원가입 이메일 -->

@include('home.component.welcomeModel')

@endsection
