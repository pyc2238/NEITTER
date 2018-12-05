@extends('layouts.app')
@section('title')
회원 프로필
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>NEITTER-회원 정보 수정</b></h3>
    <hr>

    <div class="row" style='margin-bottom:4%;margin-top:8%margin-bottom:8%;'>
        <div class="col-sm"> </div>
        <!--첫번째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.update')}}" method="post" style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <i class="fa fa-exclamation-circle"><label for="inputEmail">이메일</label></i>
                <input style="color:blue;" type="email" name="email" class="form-control" autocomplete=off value="{{Auth::user()->email}}"
                    readonly>
                <!--autocomplete 자동완성기능 off , autofocus , required-->
                <br>
                <br>

                비밀번호 <a href="{{route('user.passwordFrom',Auth::user()->id)}}"><b>[ 비밀번호 변경 ]</b></a>
                <br>
                <br>

                <i class="fa fa-exclamation-circle"><label for="inputNickname">닉네임</label></i>
                <input style="color:blue;" type="text" name="name" class="form-control" value="{{Auth::user()->name}}"
                    readonly>
                <br>
                <br>

                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>나이</label>
                            <input type="number" class="form-control" name="age" value="{{Auth::user()->age}}" min="1"
                                max="120" required>
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

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>주거지</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}"
                            autocomplete=off required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>국적</label>
                        <select id="inputState" class="form-control" name="country" required>
                            <option value="한국">한국</option>
                            <option value="일본">일본</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <br>
                <br>

                <label for="exampleFormControlFile1">대표사진</label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                <br>
                <br>

                <div class="form-group">
                    <label for="comment">자기소개</label>
                    <textarea class="form-control" rows="5" style="resize: none;" name="selfContext" autocomplete=off
                        placeholder="간단한 자기소개글을 작성해보세요!..">{{Auth::user()->selfContext}}</textarea>
                </div>
                <br>
                <br>
                <br>
                <div id="joinBtnBox">
                    <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">수정</i></button>
                    <button class="btn btn-outline-warning " type="button" onclick="location.href ='{{route('user.destroy')}}'"><i
                            class="fa fa-trash">회원탈퇴</i></button>
                    <button class="btn btn-outline-danger float-right" type='button'><i class="fa fa-database"
                            data-toggle="modal" data-target="#Modal-large-demo">내정보</i></button>
                </div>
            </form>
        </div>

        <div class="col-sm"></div>

    </div>

    <!-- profile Modal -->
    <div class="modal fade" id="Modal-large-demo" tabindex="-1" role="dialog" aria-labelledby="Modal-large-demo-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{asset('data/ProjectImages/master/userInfo.png')}}" alt="user">
                    <h5 class="modal-title" id="Modal-large-demo-label">내정보</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col">
                            @if(Auth::user()->selfPhoto == null)
                            <img src="{{asset('data/ProjectImages/master/basics.jpg')}}" alt="selfPhoto" class="img-thumbnail"
                                width="100%">
                            <h4 class="text-center" style="margin-top:3%"><b>대표사진을 설정해주세요.</b></h4>
                            @else
                            <img src="{{'/storage/slefPhoto/'.Auth::user()->selfPhoto}}" alt="selfPhoto" class="img-thumbnail"
                                width="100%">
                            <h4 class="text-center" style="margin-top:3%"><b>대표사진</b></h4>
                            @endif
                        </div>
                        <div class="col-7">
                            <h5 class="text-center" style="background-color:#ea314e;color:white;"><b>프로필</b></h5>
                            <table class="table">
                                <tr>
                                    <th>닉네임 :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->name}}<b></td>
                                </tr>
                                <tr>
                                    <th>나이 :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->age}}<b></td>
                                </tr>
                                <tr>
                                    <th>성별 :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->gender}}<b></td>
                                </tr>
                                <tr>
                                    <th>지역 :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->address}}<b></td>
                                </tr>
                                <tr>
                                    <th>가입날짜:&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->created_at}}<b></td>
                                </tr>
                                <tr>
                                    <th>자기소개:&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->selfContext}}<b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
