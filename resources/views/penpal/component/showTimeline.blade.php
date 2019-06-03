<h2 style='display:inline-block;margin-top:4%;'>@lang('penpal/show.timeline_subject')</h2>
                  
<hr>
<div class="row">

        <div class="col"></div>
        <div class="col-9">
            @foreach($timelines as $timeline)
            <div class="row timeline-card">

                <div class="col timeline-card-title">
                   
                    @if( $timeline->user->selfPhoto != null )
                    <img class="timeline-card-selfPhoto" src="{{ $timeline->user->selfPhoto }}"
                        alt="selfPhoto" width="20%" style="height:30px">
                    @endif
                    <b style="color:blue">{{ $timeline->user->name }}</b>
                    @if($timeline->user->country == 'ko')
                    <img src="{{ asset('/data/ProjectImages/community/korea.png') }}" width="13%"
                        alt="korea">
                    @else
                    <img src="{{ asset('/data/ProjectImages/community/japan.png') }}" width="13%"
                        alt="japan">
                    @endif
                </div>
                <div class="col-6 timeline-card-date">
                    {{ $timeline->created_at }}
                </div>
                <div class="col timeline-card-menu">
                   
                    @if(Auth::check() && Auth::id() == $timeline->user->id)
                    <i class="fa fa-trash float-right timeline-menuBtn"
                        style='color:red;cursor:pointer;' title='delete'
                        onclick="location.href='{{ 
                                                route('penpal.show.timeline.delete',['id' => $timeline->id])}}'">
                    </i>
                    <i class="fa fa-edit updateBtn float-right timeline-menuBtn" style='color:blue; cursor:pointer;' title='update ' id="updateBtn{{ $timeline->id }}"></i>
                    @endif
                   
                    <i class="fa fa-exchange float-right timeline-menuBtn" style='color:#06f890; cursor:pointer;' title='translation' id='translation{{ $timeline->id }}'></i>
                   
                </div>
                <div class="w-100 timeline-card-center"></div>
                <div class="col card-body">
                        
                   
                    <div class="col commentBoxsecound" id='comment{{$timeline->id}}'></div>

                    {{ $timeline->content }}
                    
                    @if( $timeline->image != null)
                    <br>
                    <img style="margin-top:20px" src="{{ $timeline->image }}" alt="content_photo"
                        class="img-thumbnail" width="80%">
                    @endif
                </div>

            </div>
            @include('penpal.component.showTimelineUpdateBox')
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
