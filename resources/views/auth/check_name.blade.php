<link rel="stylesheet" href="{{asset('/css/member.css')}}">

@if(!$name)
<div id="notice" style='font-family:"malgun gothic"'><b style="color:blue">{{$uname}}</b>@lang('auth/check_name.true')</div>
<div id="closeBtn"><button value="닫기" onclick="window.close()">@lang('auth/check_name.close')</button></div>
@else
<div id="notice" style='font-family:"malgun gothic"; color:red;'><b style="color:blue">{{$uname}}</b>@lang('auth/check_name.false')<div>
        <div id="closeBtn"><button value="닫기" onclick="window.close()">@lang('auth/check_name.close')</button></div>
        @endif
