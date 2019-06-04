 
<div class="col" style="margin-top:2%;">
    <div class="row">
        <div class="col boardsBox" style="margin-right:0.5%">
            <h5 style="padding-top:2%">@lang('home/main.community')
                <a href="{{ route('community.index') }}" class="btn btn-secondary float-right"><i
                        class="fa fa-angle-right"></i></a>
            </h5>
            <hr>

            <table>
                <tbody>
                    @foreach($communities as $community)
                    <tr>
                        <td class="boardsTd">
                            <a class="boardsFont" href="{{ route('community.show',['boardNum'=>$community->num])}}">
                                <i class="fa fa-check-square"></i>&nbsp;{{ $community->title}}
                                @if($community->comment_count != 0)
                                <span style="color:gray">({{ $community->comment_count }})</span>
                                @endif
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col boardsBox" style="margin-left:0.5%">
            <h5 style="padding-top:2%">@lang('home/main.notice')
                <a href="{{ route('notice.index') }}" class="btn btn-secondary float-right"><i
                        class="fa fa-angle-right"></i></a>
            </h5>
            <hr>
            <table>
                <tbody>
                    @foreach($notices as $notice)
                    <tr>
                        <td class="boardsTd">
                            <a class="boardsFont" href="{{ route('community.show',['boardNum'=>$notice->num])}}">
                                <i class="fa fa-exclamation-circle"></i>&nbsp;{{ $notice->title}}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
