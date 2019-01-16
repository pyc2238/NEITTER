
<div class="col-sm" style='margin-top:5%;margin-bottom:3%;'>
    <div class="input-group col-md-10">
        <select id="inputState" class="form-control" name="where" required>
            <option selected value="title">@lang('inquiry/component/indexTools.title')</option>
            <option value="writer">@lang('inquiry/component/indexTools.writer')</option>
            <option value="content">@lang('inquiry/component/indexTools.content')</option>
            <option value="titleAndcotent">@lang('inquiry/component/indexTools.titleAndcontent')</option>
        </select>
        <input id="inputText" type="search" class="form-control" name="search" autocomplete=off onkeyup="jquiryEnterkey(<?=$page?>);">
        <button class="button" type="button" onclick="jquirySearchBtn(<?=$page?>)">@lang('inquiry/component/indexTools.search')</button>
    </div>
</div>
<div class="Custompagination " style='margin-top:5%;margin-bottom:3%;'>
    @if($msgs->hasPages())
    {{$msgs->appends(['search'=>$search,'where'=>$where])->links()}}
    @endif
</div>
<div class="col-4" style='margin-top:4%'>

    @if(Auth::check())
    <button class="btn btn-outline-warning float-right" type="button"><i class="fa fa-pencil" style="font-size:15px;"
            onclick="location.href='{{route('inquiry.create',['search'=>$search,'where'=>$where,'page'=>$page])}}'">@lang('inquiry/component/indexTools.write')</i></button>
    @endif
    @if($search&& $where)
    <button class="btn btn-outline-warning  float-right" type="button" onclick="location.href='{{route('inquiry.index')}}'"><i
            class="fa fa-list" style="font-size:15px;">@lang('inquiry/component/indexTools.list')</i></button>
    @endif
</div>
