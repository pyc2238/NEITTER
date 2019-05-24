@extends('layouts.app')
@section('title')
@lang('penpal/component/timeline.title')
@endsection
@section('boards')
<link rel="stylesheet" href="{{asset('/css/penpal.css')}}">
@endsection
@section('content')
@include('penpal.component.menu')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10">
            <div class="row justify-content-center penpal-main-container">
                <div class="col">
                    <img src="{{asset("data/ProjectImages/master/logoImage/23.png")}}" width="72" alt="thumbnail">
                    <h2 style='display:inline-block;'>@lang('penpal/component/timeline.subject')</h2>
                    <p class="float-right" style="color:blue;font-size:10px">@lang('penpal/component/timeline.intro')</p>
                    <hr>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-10 timeline_tools">
                            <form class="form-group" action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <textarea name="timeline" id="" rows="4" name="comment" class='form-control'
                                            style='resize: none;'
                                            placeholder="@lang('penpal/component/timeline.placeholder')"></textarea>
                                    </div>
                                    <div class="col-2">
                                        <input id="timebutton" type="submit" class="btn btn-success" value='@lang('penpal/component/timeline.registration')'>
                                    </div>
                                </div>

                                <label for="file-input">
                                    <img src="{{ asset('/data/ProjectImages/penpal/img_input.jpg') }}" width="50"
                                        alt="imag_input_icon" style="cursor:pointer" title="add image" />
                                </label>

                                <input id="file-input" type="file" style="display:none;">

                            </form>




                        </div>
                        <div class="col"></div>
                    </div>

                </div>


            </div>
        </div>

    </div>

</div>




@endsection
