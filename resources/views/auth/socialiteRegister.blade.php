@extends('layouts.app')
@section('title')
소셜 회원가입
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-회원 가입</b></h3>
    <hr>

    <div class="row" style='margin-bottom:5%;margin-top:5%'>
        <div class="col-sm"> </div>
        <!--첫번째 그리드 박스-->
        <div class="col-sm">
            
            
            
        <form action="{{ url("socialauth/".Session::get('social')) }}" method="get" style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">
                @csrf


                <label for="name">닉네임</label>
                <input id="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete=off
                    placeholder="Nickname" required>

                <div class="checkId">
                    <input type="button" value="중복검사" onclick="checkName();" class="btn btn-primary" />
                    <input type="hidden" value="0" name="chs" />
                </div>

                <br>
                <br>
                <br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>나이</label>
                        <input type="number" class="form-control" name="age" value="{{ old('age') }}" min="1" max="120"
                            required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>성별</label>
                        <select id="inputState" class="form-control" name="gender" required>
                            <option selected value="남자">남자</option>
                            <option value="여자">여자</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->

                <br>
                <br>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>주거지</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                            autocomplete=off required>
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
                <br>
                <br>

                <div class="col text-center" style=" margin-bottom:5px">
                    <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">가입</i></button>
                    <button class="btn btn-outline-warning " type="reset"><i class="fa fa-eraser">다시쓰기</i></button>
                </div>
            </form>
        </div>

        <div class="col-sm"></div>
    </div>
</div>

@endsection
