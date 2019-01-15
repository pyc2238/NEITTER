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
                    <button class="btn btn-outline-warning " type="button" data-toggle="modal" data-target="#Modal-choice"><i
                            class="fa fa-trash">@lang('auth/profile.delete')</i></button>
                    <button class="btn btn-outline-danger float-right" type='button'><i class="fa fa-database"
                            data-toggle="modal" data-target="#Modal-large-demo">@lang('auth/profile.information')</i></button>
                </div>
            </form>
        </div>

        <div class="col-sm"></div>

    </div>


    @include('auth.component.destoryModal')
    @include('auth.component.profileModal')


</div>

@endsection
