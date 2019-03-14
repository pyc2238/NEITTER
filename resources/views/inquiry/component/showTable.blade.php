<div class="container content">
    
    <div class="col">
        <br>
        <h4>
            @if($inquiry->country == 'ko')
                <img src="{{asset('/data/ProjectImages/community/korea.png')}}" alt="korea">&nbsp;
            @else
                <img src="{{asset('/data/ProjectImages/community/japan.png')}}" alt="japan">&nbsp;
            @endif
            <b>{{$inquiry->title}}</b>
        </h4>

        <hr>

        <table class="table">
            <thead>
                <tr style="height:1px">
                    <th style="width:80px">@lang('inquiry/component/showTable.writer')</th>
                    <th>
                        {{$inquiry->user->name}}
                    </th>
                    <th style="width:80px">@lang('inquiry/component/showTable.date')</th>
                    <th>
                        {{$inquiry->created_at}}
                    </th>
                    <th style="width:58px;">@lang('inquiry/component/showTable.hits')</th>
                    <th>
                        {{$inquiry->hits}}
                    </th>
                    <th style="width:58px;">@lang('inquiry/component/showTable.commend')</th>
                    <th>
                        {{$inquiry->commend}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        {!!$inquiry->content!!}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="col text-center" style="margin-top:40%;">

            <div class="col translation">
                <button class='btn btn-warning'><b>@lang('inquiry/component/showTable.translation')</b></button>
                <div style="display:none; border:1px dashed gray;">
                    <div>
                        <br>
                        <h4> <b>{{$translationTitle}}</b></h4>
                        <br>
                        <br>
                        <br>
                        <br>
                        {!!$translationContent!!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
