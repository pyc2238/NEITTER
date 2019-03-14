<footer class="footer" style='margin-top:1%'>
    <div class="col Internationalization">

        <a href="{{url('locale/ko')}}"><img src="{{asset('data\ProjectImages\master/korea.png')}}" alt="Korea">&nbsp;&nbsp;Korean&nbsp;&nbsp;</a>
        <a href="{{url('locale/ja')}}"><img src="{{asset('data\ProjectImages\master/japan.png')}}" alt="Japan">&nbsp;&nbsp;Japanese&nbsp;&nbsp;</a>
        <a href="#" id="MOVE_TOP" class="float-right" title="MOVE_TOP"><img src="{{asset('data\ProjectImages\master/back to the top.png')}}"
                alt="back to the top"></a>
    </div>

    <div class="w-100"></div>
    <div class="col copyright">
        <div class="row">
            <div class="col-md12" style="margin-left:3%;margin-top:1%">
                <a href="{{route('home.index')}}"><img src="{{asset("data/ProjectImages/master/footerLog.png")}}" alt="Logo"
                        ondragstart="return false"></a>
            </div>
            <div class="col-md4 copyright" style="margin-left:3%;">
                <a href="{{route('home.introduction')}}"><b>@lang('home/footer.introduction')</b></a>&nbsp; |
                <a href="{{route('home.policy')}}"><b>@lang('home/footer.site_policy')</b></a>&nbsp; |
                <a href="{{route('home.creator')}}"><b>@lang('home/footer.creator')</b></a>&nbsp; |
                <a href="{{route('home.development')}}"><b>@lang('home/footer.skill')</b></a>&nbsp; |
            <a href="{{route('inquiry.index')}}"><b>@lang('home/footer.report')</b></a>&nbsp; |
                <a href="mailto:pyc2238@gmail.com"><b>@lang('home/footer.inquiry')</b></a>&nbsp; | &nbsp;
                <span style="cursor: pointer" data-tooltip-text="@lang('home/footer.escort')"><img src="{{asset("data/ProjectImages/master/escort.png")}}"
                        alt="escort"></span>
                <br>
                <br>
                @if(Session::get('locale') == 'ja')
                代表メール：pyc2238@gmail.com
                @else
                서비스 운영<br>
                주소: 강원 원주시 봉산동 1198-8 TEL: 010-2238-2639, 이메일 : pyc2238@naver.com
                <br>
                <br>
                시스템 운영<br>
                YJCWDJ(주) 대표이사: 박보근 부대표: 곽민수 청소부: 김승연 / 사업자번호: 1501107
                주소: 대구 북구 복현 찬누리 335-13 207호
                @endif
                <br>
                <br>
                Copyright © Gratefuldays Corp. All rights reserved.<br>
                Copyright © Joyandnetworks Corp. All rights reserved.<br>
                Copyright © Korea Japan Culture Exchange NEITTER All rights reserved<br>
            </div>
        </div>

    </div>
</footer>
