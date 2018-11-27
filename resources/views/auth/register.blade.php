@extends('layouts.app')
@section('title')
회원가입
@endsection
@section('content')

<div class="container">
        <br>
        <h3>NEITTER-로그인</h3>
        <hr>
    <div class="row justify-content-center" style="margin-bottom:2%">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">양식에 따라 작성하십시오.</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <label for="email">이메일</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete=off placeholder="Email" required>
                        @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        <!--autocomplete 자동완성기능 off , autofocus , required-->
                        <br>
                        <label for="password">비밀번호</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <small style="color:red"><i class="fa fa-exclamation-circle">8~15자,영문,숫자,특수문자가 들어가야 합니다.</i></small>
                        <br><br>

                        <label for="password-confirm">비밀번호 확인</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>


                        <br>
                        <label for="name">닉네임</label>
                        <input id="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete=off placeholder="Nickname" required>
                     
                                <div class="checkId">
                                    <input type="button" value="중복검사" onclick="checkName();" class="btn btn-primary" />
                                    <input type="hidden" value="0" name="chs" />
                                </div>
                        
                        <br>
                      
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>나이</label>
                                <input type="number" class="form-control" name="age" value="{{ old('age') }}" min="1" max="120" required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>성별</label>
                                <select id="inputState" class="form-control" name="gender"  required>
                                    <option selected value="남자">남자</option>
                                    <option value="여자">여자</option>
                                </select>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row.// -->
            
            
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>주거지</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}" autocomplete=off required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>국적</label>
                                <select id="inputState" class="form-control" name="country" required>
                                    <option selected value="한국">한국</option>
                                    <option value="일본">일본</option>
                                </select>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row.// -->
            
                        <br>
            
                        <div class="col text-center" style=" margin-bottom:5px">
                            <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">가입</i></button>
                            <button class="btn btn-outline-warning " type="reset"><i class="fa fa-eraser">다시쓰기</i></button>
                        </div>




@endsection
