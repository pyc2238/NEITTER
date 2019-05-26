<div class="col-sm" style='margin-top:5%;margin-bottom:3%;'>
    <div class="input-group col-md-10">
        <select id="inputState" class="form-control" name="where" required>
            <option selected value="title">@lang('notice/component/indexTools.title')</option>
            <option value="writer">@lang('notice/component/indexTools.writer')</option>
            <option value="content">@lang('notice/component/indexTools.content')</option>
            <option value="titleAndcotent">@lang('notice/component/indexTools.titleAndcontent')</option>
        </select>
        <input id="inputText" type="search" class="form-control" name="search" autocomplete=off onkeyup="enterkey('notice');">
        <button class="button" type="button" onclick="searchBtn('notice')">@lang('notice/component/indexTools.search')</button>
    </div>
</div>
<div class="Custompagination " style='margin-top:5%;margin-bottom:3%;'>
    @if($msgs->hasPages())
    {{$msgs->appends(['search'=>$search,'where'=>$where])->onEachSide(5)->links()}}
    @endif
</div>
<div class="col-4" style='margin-top:4%'>

    @if(Auth::check())
        @if(Auth::user()->admin == 1)
        <button class="btn btn-outline-warning float-right" type="button"><i class="fa fa-pencil" style="font-size:15px;"
                onclick="location.href='{{route('notice.create',['search'=>$search,'where'=>$where,'page'=>$page])}}'">@lang('notice/component/indexTools.write')</i></button>
        @endif
    @endif
    @if($search&& $where)
    <button class="btn btn-outline-warning  float-right" type="button" onclick="location.href='{{route('notice.index')}}'"><i
            class="fa fa-list" style="font-size:15px;">@lang('notice/component/indexTools.list')</i></button>
    @endif
</div>
