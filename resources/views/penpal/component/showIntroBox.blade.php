<div class="row">
        <div class="col">
         
        </div>
        <div class="col-11">
                <table class="show-table">

                        <tr>
                    
                            <td rowspan=3>
                    
                                @if($friend->image != null)
                                    <img src="{{ $friend->image }}" alt="No Image" style="max-width: none; height: 345px; display: inline; "
                                        height="345px" width="300px" class="img-thumbnail">
                                @else
                                    @if($friend->user->selfPhoto != null)
                                        <img src="{{ $friend->user->selfPhoto }}" alt="No Image"
                                            style="max-width: none; height: 345px; display: inline; " height="345px" width="300px"
                                            class="img-thumbnail">
                    
                                     @else
                                        <img src="{{ asset("data/ProjectImages/master/logoImage/6.png") }}" alt="No Image"
                                            style="max-width: none; height: 345px; display: inline; " height="345px" width="300px"
                                            class="img-thumbnail">
                                     @endif
                    
                                @endif
                    
                                <div class="col text-center show-goal-box" style="height:40px; padding-top:3%;">
                                    <strong style="font-size:13.11111px">@lang('penpal/show.goal')</strong>:
                                    @if($friend->goal_id == 1)
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason1')</span>
                                    @elseif($friend->goal_id == 2)
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason2')</span>
                                    @elseif($friend->goal_id == 3)
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason3')</span>
                                    @elseif($friend->goal_id == 4)
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason4')</span>
                                    @elseif($friend->goal_id == 5)
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason5')</span>
                                    @else
                                        <span style="font-size:13.11111px">@lang('penpal/show.reason6')</span>
                                    @endif
                    
                                </div>
                                <div class="col text-center show-language-box" style="height:40px; padding-top:3%;">
                                    <strong style="font-size:13.11111px">@lang('penpal/show.available_language')</strong>:
                    
                                    @for($i = 0; $i < count($friend->language); $i++)
                                        @if($friend->language[$i] == "1")
                                            <span><img src="{{ asset("data/ProjectImages/master/korea.png") }}" alt="korea"></span>
                                        @elseif($friend->language[$i] == "2")
                                            <span><img src="{{ asset("data/ProjectImages/master/japan.png") }}" alt="japan"></span>
                                        @else
                                            <span><img src="{{ asset("data/ProjectImages/master/united-kingdom.png") }}"
                                                alt="united-kingdom"></span>
                                        @endif
                                    @endfor
                    
                                </div>
                            </td>
                    
                    
                        </tr>
                    
                        <tr>
                    
                            <td class="show-table-self_context" colspan=3 style="height:35%; width:100%; vertical-align: top; padding:2%">
                                <p>{{ $friend->self_context }}</p>
                                <span id="translation_content"><b>@lang('penpal/show.translation_content')</b></span>
                                <div style="display:none; border:1px dashed gray;">
                                    <div style="padding:2%">
                                        <p>{{ $friend->translation }}</p>
                                    </div>
                                </div>
                            </td>
                    
                        </tr>
                    
                        <tr>
                            <td class="show-table-bottom" colspan=3 style="height:65%; vertical-align: top; padding:2%;">
                    
                            </td>
                        </tr>
                    
                    </table>
        </div>
        <div class="col">
         
        </div>
      </div>




​
