@extends('layouts.app')
@section('title')
@lang('penpal/component/timeline.title')
@endsection
@section('penpal')
<link rel="stylesheet" href="{{ asset('/css/timeline.css') }}">
<script src="{{ asset('/js/timeline.js') }}"></script>
@endsection
@section('content')
@include('penpal.component.menu')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10">
            <div class="row justify-content-center timeline-main-container">
                <div class="col timeline-card-box">
                    <img src="{{ asset("data/ProjectImages/master/logoImage/23.png") }}" width="72" alt="thumbnail">
                    <h2 style='display:inline-block;'>@lang('penpal/component/timeline.subject')</h2>
                    <p class="float-right" style="color:blue;font-size:10px">@lang('penpal/component/timeline.intro')
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-10 timeline_tools">
                            <form class="form-group" action="{{ route('penpal.timeline.create') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <textarea id="" rows="4" name="content" class='form-control'
                                            style='resize: none;'
                                            placeholder="@lang('penpal/component/timeline.placeholder')"></textarea>
                                    </div>
                                    <div class="col-2">
                                        <input id="timebutton" type="submit" class="btn btn-success" value='@lang('penpal/component/timeline.registration')'/>
                                     </div>
                                </div> 
                                        <label for="file-input">
                                            <img src="{{ asset('/data/ProjectImages/penpal/img_input.jpg') }}" width="50"
                                                alt="imag_input_icon" style="cursor:pointer" title="add image" />
                                        </label>

                                        <input id="file-input" type="file" name="file" style="display:none;"
                                            onchange="previewImage(this,'View_area')" />
                                        <br>
                                        <div id='View_area' onclick="deleteImg()"></div>
                            </form>

                        </div>
                        <div class="col"></div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col"></div>
                        <div class="col-10">
                            @foreach($timelines as $timeline)
                            <div class="row timeline-card">

                                <div class="col timeline-card-title">
                                    @if($timeline->is_system == 1)
                                    <b style="color:blue">SYSTEM</b>
                                    @else
                                    @if( $timeline->user->selfPhoto != null )
                                    <img class="timeline-card-selfPhoto" src="{{ $timeline->user->selfPhoto }}"
                                        alt="selfPhoto" width="17%">
                                    @endif
                                    <b style="color:blue">{{ $timeline->user->name }}</b>
                                    @if($timeline->user->country == 'ko')
                                    <img src="{{ asset('/data/ProjectImages/community/korea.png') }}" width="13%"
                                        alt="korea">
                                    @else
                                    <img src="{{ asset('/data/ProjectImages/community/japan.png') }}" width="13%"
                                        alt="japan">
                                    @endif
                                    @endif
                                </div>
                                <div class="col-6 timeline-card-date">
                                    {{ $timeline->created_at }}
                                </div>
                                <div class="col timeline-card-menu">
                                   
                                    @if(Auth::check() && Auth::id() == $timeline->user->id && $timeline->is_system == 0)
                                    <i class="fa fa-trash float-right timeline-menuBtn"
                                        style='color:red;cursor:pointer;' title='delete'
                                        onclick="location.href='{{ 
                                                                route('penpal.timeline.delete',['id' => $timeline->id])}}'">
                                    </i>
                                    <i class="fa fa-edit updateBtn float-right timeline-menuBtn" style='color:blue; cursor:pointer;' title='update ' id="updateBtn{{ $timeline->id }}"></i>
                                    @endif
                                    @if($timeline->is_system != 1)
                                        <i class="fa fa-exchange float-right timeline-menuBtn" style='color:#06f890; cursor:pointer;' title='translation' id='translation{{ $timeline->id }}'></i>
                                    @endif
                                </div>
                                <div class="w-100 timeline-card-center"></div>
                                <div class="col card-body">
                                        
                                    @if($timeline->is_system == 1)
                                    {{ $timeline->user->name }}님이 펜팔을 등록했습니다.
                                    @else
                                    <div class="col commentBoxsecound" id='comment{{$timeline->id}}'></div>

                                    {{ $timeline->content }}
                                    @endif

                                    <br>
                                    @if($timeline->is_system == 1)
                                    
                                        {{ $timeline->user->name }}様がペンパルを登録しました。
                                    
                                    @endif

                                    @if( $timeline->image != null)
                                    <br>
                                    <img style="margin-top:20px" src="{{ $timeline->image }}" alt="content_photo"
                                        class="img-thumbnail" width="80%">
                                    @endif
                                </div>

                            </div>
                            @include('penpal.component.timelineUpdateBox')
                            @endforeach
                        </div>
                        <div class="col"></div>

                    </div>

                    <div class="row timeline-pageBox">
                        <div class="col">

                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            @if ($timelines->hasPages())
                                {{ $timelines->onEachSide(5)->links() }}
                            @endif
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection
