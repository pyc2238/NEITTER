{{-- @section('search')
    <script type="text/javascript" src="{{asset('/jquery/lib/jquery.js')}}"></script>
    <script type='text/javascript' src="{{asset('/jquery/lib/jquery.bgiframe.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('/jquery/lib/jquery.ajaxQueue.js')}}"></script>
    <script type='text/javascript' src="{{asset('/jquery/jquery.autocomplete.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/jquery/jquery.autocomplete.css')}}" />
    
@endsection --}}


<div class="col-sm" style='margin-top:5%;margin-bottom:3%;'>
    <div class="input-group col-md-10">
        <select id="inputState" class="form-control" name="where" required>
            <option selected value="title">@lang('community/component/indexTools.title')</option>
            <option value="writer">@lang('community/component/indexTools.writer')</option>
            <option value="content">@lang('community/component/indexTools.content')</option>
            <option value="titleAndcotent">@lang('community/component/indexTools.titleAndcontent')</option>
        </select>
        <input id="inputText" type="search" class="form-control" name="search" autocomplete=off onkeyup="enterkey(<?=$page?>);">
        <button class="button" type="button" onclick="searchBtn(<?=$page?>)">@lang('community/component/indexTools.search')</button>
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
            onclick="location.href='{{route('community.create',['search'=>$search,'where'=>$where,'page'=>$page])}}'">@lang('community/component/indexTools.write')</i></button>
    @endif
    @if($search&& $where)
    <button class="btn btn-outline-warning  float-right" type="button" onclick="location.href='{{route('community.index')}}'"><i
            class="fa fa-list" style="font-size:15px;">@lang('community/component/indexTools.list')</i></button>
    @endif
</div>
{{-- 
<script language="javascript">
    var autoSearch = {!!$autoSearch!!}
    searchDB(autoSearch);

</script> --}}
