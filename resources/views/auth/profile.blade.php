@extends('layouts.app')
@section('title')
@lang('auth/profile.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>@lang('auth/profile.subject')</b></h3>
    <hr>

    <div class="row" style='margin-bottom:4%;margin-top:8%margin-bottom:8%;'>
        <div class="col-sm"> </div>
        <!--첫번째 그리드 박스-->
        <div class="col-sm">

            <form action="{{route('user.update')}}" method="post" style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <i class="fa fa-exclamation-circle"><label for="inputEmail">@lang('auth/profile.email')</label></i>
                <input style="color:blue;" type="email" name="email" class="form-control" autocomplete=off value="{{Auth::user()->email}}"
                    readonly>
                <!--autocomplete 자동완성기능 off , autofocus , required-->
                <br>
                <br>

                @lang('auth/profile.password') <a href="{{route('user.passwordFrom',Auth::user()->id)}}"><b>[
                        @lang('auth/profile.password_update') ]</b></a>
                <br>
                <br>

                <i class="fa fa-exclamation-circle"><label for="inputNickname">@lang('auth/profile.nickname')</label></i>
                <input style="color:blue;" type="text" name="name" class="form-control" value="{{Auth::user()->name}}"
                    readonly>
                <br>
                <br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('auth/profile.age')</label>
                        <input type="number" class="form-control" name="age" value="{{Auth::user()->age}}" min="1" max="120"
                            required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>@lang('auth/profile.gender')</label>
                        <select id="inputState" class="form-control" name="gender" required>
                            <option selected value="남자">@lang('auth/profile.men')</option>
                            <option value="여자">@lang('auth/profile.women')</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <br>
                <br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('auth/profile.area')</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->address}}"
                            autocomplete=off required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>@lang('auth/profile.country')</label>
                        <select id="inputState" class="form-control" name="country" required>
                            <option value="한국">@lang('auth/profile.korea')</option>
                            <option value="일본">@lang('auth/profile.japan')</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->
                <br>
                <br>

                <label for="exampleFormControlFile1">@lang('auth/profile.photo')</label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                <br>
                <br>

                <div class="form-group">
                    <label for="comment">@lang('auth/profile.self_introduction')</label>
                    <textarea class="form-control" rows="5" style="resize: none;" name="selfContext" autocomplete=off
                        placeholder="@lang('auth/profile.self_introduction_notice')">{{Auth::user()->selfContext}}</textarea>
                </div>
                <br>
                <br>
                <br>
                <div id="joinBtnBox">
                    <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">@lang('auth/profile.modify')</i></button>
                    <button class="btn btn-outline-warning " type="button" onclick="location.href ='{{route('user.destroy')}}'"><i
                            class="fa fa-trash">@lang('auth/profile.delete')</i></button>
                    <button class="btn btn-outline-danger float-right" type='button'><i class="fa fa-database"
                            data-toggle="modal" data-target="#Modal-large-demo">@lang('auth/profile.information')</i></button>
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
                    <h5 class="modal-title" id="Modal-large-demo-label">@lang('auth/profile.model_information')</h5>
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
                            <h4 class="text-center" style="margin-top:3%"><b>@lang('auth/profile.model_notice')</b></h4>
                            @else
                            <img src="{{'/storage/slefPhoto/'.Auth::user()->selfPhoto}}" alt="selfPhoto" class="img-thumbnail"
                                width="100%">
                            <h4 class="text-center" style="margin-top:3%"><b>@lang('auth/profile.model_photo')</b></h4>
                            @endif
                        </div>
                        <div class="col-7">
                            <h5 class="text-center" style="background-color:#ea314e;color:white;"><b>@lang('auth/profile.model_profile')</b></h5>
                            <table class="table">
                                <tr>
                                    <th>@lang('auth/profile.model_nickname') :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->name}}<b></td>
                                </tr>
                                <tr>
                                    <th>@lang('auth/profile.model_age') :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->age}}<b></td>
                                </tr>
                                <tr>
                                    <th>@lang('auth/profile.model_gender') :&nbsp;</th>

                                    @if(Auth::user()->gender == '남자')

                                    <td><img src="{{asset("data/ProjectImages/master/men.png")}}" alt="men"></td>
                                    @else
                                    <td><img src="{{asset("data/ProjectImages/master/women.png")}}" alt="women"></td>
                                    @endif

                                </tr>
                                <tr>
                                    <th>@lang('auth/profile.model_area') :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->address}}<b></td>
                                </tr>
                                <tr>
                                    <th>@lang('auth/profile.model_Date_of_entry') :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->created_at}}<b></td>
                                </tr>
                                <tr>
                                    <th>@lang('auth/profile.model_self_introduction') :&nbsp;</th>
                                    <td><b style="color:blue">{{Auth::user()->selfContext}}<b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('auth/profile.model_check')</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
