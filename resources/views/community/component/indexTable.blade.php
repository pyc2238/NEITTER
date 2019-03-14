<table class="table table-hover" style="table-layout:fixed">
    <thead class="thead">
        <tr>
            <th class="text-center" style="width:55px;">@lang('community/component/indexTable.number')</th>
            <th style="width:50px;"></th>
            <th>@lang('community/component/indexTable.title')</th>
            <th style="width:150px;">@lang('community/component/indexTable.writer')</th>
            <th style="width:60px;">@lang('community/component/indexTable.date')</th>
            <th class="text-right" style="width:70px;">@lang('community/component/indexTable.hits')</th>
            <th class="text-right" style="width:70px;">@lang('community/component/indexTable.commend')</th>
            <th class="text-right" style="width:150px;">@lang('community/component/indexTable.modify')</th>
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
            <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href="{{route('community.show',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"><b>{{$msg->title}}</b></a></td>

            @if($where == 'writer')
            <td style="width:150px;"><b>{{$msg->name}}</b></td>
            @else
            <td style="width:150px;"><b>{{$msg->user->name}}</b></td>
            @endif
            <td style="width:60px;"><b>{{date('m-d',strtotime($msg->created_at))}}</b></td>
            <td class="text-right" style="width:70px;"><b>{{$msg->hits}}</b></td>
            <td class="text-right" style="width:70px;"><b>{{$msg->commend}}</b></td>
            <td class="text-right" style="width:150px;">
                <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" onclick="location.href='{{route('community.edit',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
                    <h2><i class="fa fa-edit"></i></h2>
                </button>
                <form style="display:inline-block" id="destory-form{{$msg->num}}" action="{{route('community.destroy',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-toggle="modal"
                        data-target="#Modal-choice{{$msg->num}}">
                        <h2><i class="fa fa-trash"></i></h2>
                    </button>

                </form>
            </td>
        </tr>
        @include('community.component.destoryModal')
        @endforeach
    </tbody>
</table>
