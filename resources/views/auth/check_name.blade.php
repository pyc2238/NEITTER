<link rel="stylesheet" href="{{asset('/css/member.css')}}">

@if(!$name)
<div id="notice" style='font-family:"malgun gothic"'>{{$uname}}은 사용가능한 닉네임입니다.</div>
<div id="closeBtn"><button value="닫기" onclick="window.close()">닫기</button></div>
@else
<div id="notice" style='font-family:"malgun gothic"; color:red;'>{{$uname}}은 중복된 닉네임입니다.<div>
        <div id="closeBtn"><button value="닫기" onclick="window.close()">닫기</button></div>
        @endif
