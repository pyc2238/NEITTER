<table class="table table-hover" style="table-layout:fixed">
    <thead class="thead">
        <tr>
            <th class="text-center" style="width:55px;">@lang('notice/component/indexTable.number')</th>
            <th style="width:50px;"></th>
            <th>@lang('notice/component/indexTable.title')</th>
            <th style="width:120px;">@lang('notice/component/indexTable.writer')</th>
            <th style="width:70px;">@lang('notice/component/indexTable.date')</th>
            <th class="text-right" style="width:70px;">@lang('notice/component/indexTable.hits')</th>
        </tr>
    </thead>
    <tbody>


        @foreach($msgs as $msg)
        <tr>
            <td style="width:60px;"><b>{{$msg->num}}</b></td>
            <td style="width:50px;">
                @if($msg->country == 'ko')
                    <img src="{{asset('/data/ProjectImages/community/korea.png')}}" alt="korea">
                @else
                    <img src="{{asset('/data/ProjectImages/community/japan.png')}}" alt="japan">
                @endif    
            </td>
            <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><b style="color:red">[공지]</b>&nbsp;<a href="{{route('notice.show',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"><b>{{$msg->title}}</b></a></td>
            @if($where == 'writer')
            <td style="width:150px;"><b>{{$msg->name}}</b></td>
            @else
            <td style="width:120px;"><b>{{$msg->user->name}}</b></td>
            @endif
            <td style="width:60px;"><b>{{date('m-d',strtotime($msg->created_at))}}</b></td>
            <td class="text-right" style="width:70px;"><b>{{$msg->hits}}</b></td>
        </tr>
        @endforeach
    </tbody>
</table>
