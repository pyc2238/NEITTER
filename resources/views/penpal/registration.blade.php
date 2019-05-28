@extends('layouts.app')
@section('title')
@lang('penpal/component/registration.title')
@endsection
@section('penpal')
<link rel="stylesheet" href="{{asset('/css/penpal.css')}}">
@endsection
@section('content')
@include('penpal.component.menu')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-10">
            <div class="row justify-content-center penpal-registration-container">
                <div class="col">
                    <img src="{{asset("data/ProjectImages/master/logoImage/12.png")}}" width="72" alt="thumbnail">
                    <h2 style='display:inline-block;'>@lang('penpal/component/registration.subject')</h2>
                    <hr>

                    <div class="row">
                        <div class="col">

                        </div>

                        <div class="col-6">
                            <form action="{{ route('penpal.penpal.registration') }}" method="post"
                                style="margin-top:8%;margin-bottom:8%" enctype="multipart/form-data">

                                @csrf

                                <i class="fa fa-exclamation-circle"><label
                                        for="inputNickname"><b>@lang('penpal/component/registration.nickname')</b></label></i>
                                <input style="color:blue;" type="text" name="name" class="form-control"
                                    value="{{Auth::user()->name}}" readonly>
                                <br>
                                <br>

                                <i class="fa fa-exclamation-circle"><label
                                        for="inputNickname"><b>@lang('penpal/component/registration.country')</b></label></i>
                                <input style="color:blue;" type="text" name="name" class="form-control"
                                    value="{{ Auth::user()->country }}" readonly>
                                <br>
                                <br>

                                <div class="form-group">
                                    <label
                                        for="comment"><b>@lang('penpal/component/registration.selfContext')</b></label>
                                    <textarea class="form-control" rows="5" style="resize: none;" name="selfContext"
                                        autocomplete=off
                                        placeholder="@lang('auth/profile.self_introduction_notice')" required>{{Auth::user()->selfContext}}</textarea>
                                </div>
                                <br>
                                <br>

                                <b>@lang('penpal/component/registration.language')</b>
                                <br>
                                <div class="form-check form-check-inline">

                                    <input checked class="form-check-input" type="checkbox" name="language[]" id="inlineCheckbox1" value="1">
                                    <label class="form-check-label"
                                        for="inlineCheckbox1">@lang('penpal/component/registration.kor')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="language[]" id="inlineCheckbox2" value="2">
                                    <label class="form-check-label"
                                        for="inlineCheckbox2">@lang('penpal/component/registration.jp')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="language[]" id="inlineCheckbox3" value="3">
                                    <label class="form-check-label"
                                        for="inlineCheckbox3">@lang('penpal/component/registration.eng')</label>
                                </div>
                                <br>
                                <br>


                                <label><b>@lang('penpal/component/registration.goal')</b></label>
                                <select id="inputState" class="form-control" name="goal" required>
                                    <option selected value="1">@lang('penpal/component/registration.reason1')</option>
                                    <option value="2">@lang('penpal/component/registration.reason2')</option>
                                    <option value="3">@lang('penpal/component/registration.reason3')</option>
                                    <option value="4">@lang('penpal/component/registration.reason4')</option>
                                    <option value="5">@lang('penpal/component/registration.reason5')</option>
                                    <option value="6">@lang('penpal/component/registration.reason6')</option>
                                </select>


                                <br>
                                <br>

                                <label
                                    for="exampleFormControlFile1">@lang('penpal/component/registration.photo')</label>
                                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1" required>

                                <br>
                                <br>
                                <br>

                                <div id="joinBtnBox">
                                    <button class="btn btn-outline-warning " type="submit"><i
                                            class="fa fa-pencil">@lang('penpal/component/registration.registration')</i></button>
                                    <button class="btn btn-outline-danger " type="button"
                                        onclick="location.href='{{ route('penpal.index') }}' "><i
                                            class="fa fa-trash">@lang('penpal/component/registration.cancellation')</i></button>

                                </div>
                            </form>

                        </div>
                        <div class="col">

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>




@endsection
