@extends('layouts.app')
@section('title')
@lang('auth/socialiteRegister.title')
@endsection
@section('content')
<div class="container content">
    <br>
    <h3><b>@lang('auth/socialiteRegister.subject')</b></h3>
    <hr>

    <div class="row" style='margin-bottom:5%;margin-top:5%'>
        <div class="col-sm"> </div>
        <!--첫번째 그리드 박스-->
        <div class="col-sm">
            
            
            
        <form action="{{ url("socialauth/".Session::get('social')) }}" method="get" style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">
                @csrf


                <label for="name">@lang('auth/socialiteRegister.nickname')</label>
                <input id="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete=off
                    placeholder="Nickname" required>

                <div class="checkId">
                    <input type="button" value="@lang('auth/socialiteRegister.nickname_check')" onclick="checkName();" class="btn btn-primary" />
                    <input type="hidden" value="0" name="chs" />
                </div>

                <br>
                <br>
                <br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('auth/socialiteRegister.age')</label>
                        <input type="number" class="form-control" name="age" value="{{ old('age') }}" min="1" max="120"
                            required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>@lang('auth/socialiteRegister.gender')</label>
                        <select id="inputState" class="form-control" name="gender" required>
                            <option selected value="남자">@lang('auth/socialiteRegister.men')</option>
                            <option value="여자">@lang('auth/socialiteRegister.women')</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->

                <br>
                <br>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('auth/socialiteRegister.area')</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                            autocomplete=off required>
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>@lang('auth/socialiteRegister.country')</label>
                        <select id="inputState" class="form-control" name="country" required>
                            <option selected value="한국">@lang('auth/socialiteRegister.korea')</option>
                            <option value="일본">@lang('auth/socialiteRegister.japan')</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row.// -->

                <br>
                <br>
                <br>

                <div class="col text-center" style=" margin-bottom:5px">
                    <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">@lang('auth/socialiteRegister.sign')</i></button>
                    <button class="btn btn-outline-warning " type="reset"><i class="fa fa-eraser">@lang('auth/socialiteRegister.reset')</i></button>
                </div>
            </form>
        </div>

        <div class="col-sm"></div>
    </div>
</div>

@endsection
