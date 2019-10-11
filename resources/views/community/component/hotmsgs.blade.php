<div class="row" style="margin-left:20px;margin-right:20px;">
    <div style="border-left:1px solid gray;border-top:1px solid gray;border-right:1px solid gray; padding:3px">
        <span id="hot-hits" style="font-size: 18px;font-weight: bold;">@lang('community/component/hotmsgs.hits')</span>
    </div>
    <div style="border-top:1px solid gray;border-right:1px solid gray; padding:3px">
        <span id="hot-commend"
            style="font-size: 18px;font-weight: bold;">@lang('community/component/hotmsgs.commend')</span>
    </div>
    <div style="border-top:1px solid gray;border-right:1px solid gray; padding:3px">
        <span id="hot-comment"
            style="font-size: 18px;font-weight: bold;">@lang('community/component/hotmsgs.comment')</span>
    </div>

</div>


<div id="hot-hits-box" class="row" style="margin-left:20px;margin-right:20px;margin-bottom:20px">
    @php
    $i=1;
    @endphp
    @foreach($hitMsgs->chunk(5) as $hitMsg)
    <div class="col-sm" style="border:1px solid gray;  box-shadow: 0 4px 0.5px -4px gray;">
        <table>
            <tbody>
                @foreach($hitMsg as $hit)
                <tr>
                    <td class="hot-boards" style="width:425px;">
                        <a class="hottitle" href="{{ route('community.show',['boardNum'=>$hit->num])}}">
                            @if($i == 1 || $i == 2 || $i == 3 )
                            <span class="hotboard" style="color:#03835b">{{ $i++ }}</span>&nbsp;{{ $hit->title}}
                            @else
                            <span class="hotboard">{{ $i++ }}</span>&nbsp;{{ $hit->title}}
                            @endif
                            @if($hit->comment_count != 0)
                            [<span style="color:red; font-size:11px;">{{ $hit->comment_count }}</span>]

                            @endif
                        </a>
                    </td>
                    @if($i == 2 || $i == 3 || $i == 4 )
                    <td class="text-right"><img src="{{ asset('/data/ProjectImages/community/hot-icon.gif') }}"
                            style="width:35%;margin-right:13%;" alt="hot"></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>

<div id="hot-commend-box" class="row" style="margin-left:20px;margin-right:20px;margin-bottom:20px;display:none">
    @php
    $i=1;
    @endphp
    @foreach($hotMsgs->chunk(5) as $hotMsg)
    <div class="col-sm" style="border:1px solid gray;  box-shadow: 0 4px 0.5px -4px gray;">
        <table>
            <tbody>
                @foreach($hotMsg as $hot)
                <tr>
                    <td class="hot-boards" style="width:425px;">
                        <a class="hottitle" href="{{ route('community.show',['boardNum'=>$hot->num])}}">
                            @if($i == 1 || $i == 2 || $i == 3 )
                            <span class="hotboard" style="color:#03835b">{{ $i++ }}</span>&nbsp;{{ $hot->title}}
                            @else
                            <span class="hotboard">{{ $i++ }}</span>&nbsp;{{ $hot->title}}
                            @endif
                            @if($hot->comment_count != 0)
                            [<span style="color:red; font-size:11px;">{{ $hot->comment_count }}</span>]
                            @endif
                        </a>
                    </td>
                    @if($i == 2 || $i == 3 || $i == 4 )
                    <td class="text-right"><img src="{{ asset('/data/ProjectImages/community/hot-icon.gif') }}"
                            style="width:35%;margin-right:13%" alt="hot"></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>


<div id="hot-comment-box" class="row" style="margin-left:20px;margin-right:20px;margin-bottom:20px;display:none">
    @php
    $i=1;
    @endphp
    @foreach($commentMsgs->chunk(5) as $commentMsg)
    <div class="col-sm" style="border:1px solid gray;  box-shadow: 0 4px 0.5px -4px gray;">
        <table>
            <tbody>
                @foreach($commentMsg as $comment)
                <tr>
                    <td class="hot-boards" style="width:425px;">
                        <a class="hottitle" href="{{ route('community.show',['boardNum'=>$comment->num])}}">
                            @if($i == 1 || $i == 2 || $i == 3 )
                            <span class="hotboard" style="color:#03835b">{{ $i++ }}</span>&nbsp;{{ $comment->title}}
                            @else
                            <span class="hotboard">{{ $i++ }}</span>&nbsp;{{ $comment->title}}
                            @endif
                            @if($comment->comment_count != 0)
                            [<span style="color:red; font-size:11px;">{{ $comment->comment_count }}</span>]
                            @endif
                        </a>
                    </td>
                    @if($i == 2 || $i == 3 || $i == 4 )
                    <td class="text-right"><img src="{{ asset('/data/ProjectImages/community/hot-icon.gif') }}"
                            style="width:35%;margin-right:13%" alt="hot"></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>
