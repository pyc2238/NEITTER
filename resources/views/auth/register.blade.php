@extends('layouts.app')
@section('title')
@lang('auth/register_form.title')
@endsection
@section('content')
<div class="container content">
    <div class="container">
        <br>
        <h3><b>@lang('auth/register_form.subject')</b></h3>
        <hr>
        <div class="row justify-content-center" style="margin-bottom:2%">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('auth/register_form.guide')</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <label for="email">@lang('auth/register_form.email')</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" autocomplete=off placeholder="Email" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <!--autocomplete 자동완성기능 off , autofocus , required-->
                            <br>
                            <label for="password">@lang('auth/register_form.password')</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            
                            <small style="color:red"><i class="fa fa-exclamation-circle">@lang('auth/register_form.notice')</i></small>
                            
                            <br><br>

                            <label for="password-confirm">@lang('auth/register_form.password_check')</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required>


                            <br>
                            <label for="name">@lang('auth/register_form.nickname')</label>
                            <input id="name" class="form-control" name="name" value="{{ old('name') }}" autocomplete=off
                                placeholder="Nickname" required>

                            <div class="checkId">
                                <input type="button" value="@lang('auth/register_form.nickname_check')" onclick="checkName();" class="btn btn-primary" />
                                <input type="hidden" value="0" name="chs" />
                            </div>

                            <br>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>@lang('auth/register_form.age')</label>
                                    <input type="number" class="form-control" name="age" value="{{ old('age') }}" min="1"
                                        max="120" required>
                                </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <label>@lang('auth/register_form.gender')</label>
                                    <select id="inputState" class="form-control" name="gender" required>
                                        <option selected value="남자">@lang('auth/register_form.men')</option>
                                        <option value="여자">@lang('auth/register_form.women')</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row.// -->


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>@lang('auth/register_form.area')</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        autocomplete=off required>
                                </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <label>@lang('auth/register_form.country')</label>
                                    <select id="inputState" class="form-control" name="country" required>
                                        <option selected value="ko">@lang('auth/register_form.korea')</option>
                                        <option value="jp">@lang('auth/register_form.japan')</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row.// -->

                            <br>

                            <div class="col text-center" style=" margin-bottom:5px">
                                <button class="btn btn-outline-warning " type="submit"><i class="fa fa-pencil">@lang('auth/register_form.sign')</i></button>
                                <button class="btn btn-outline-warning " type="reset"><i class="fa fa-eraser">@lang('auth/register_form.reset')</i></button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
