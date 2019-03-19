<div class="modal fade" id="Modal-small" tabindex="-1" role="dialog" aria-labelledby="Modal-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-small">@lang('home/component/welcomeModal.subject')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <img width="100%" src="{{asset("data/ProjectImages/master/logoImage/registered.gif")}}" alt="회원가입 성공">
            </div>
            <b class="text-center"> <a href="{{url('introduction')}}">@lang('home/component/welcomeModal.introduction')</a></b>
            <br>
            @if(Auth::user())
                <p class="text-center"><a href="{{route('user.info',Auth::user()->id)}}">@lang('home/component/welcomeModal.go_profile')</a>@lang('home/component/welcomeModal.notice')</p>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('home/component/welcomeModal.check')</button>
            </div>
        </div>
    </div>
</div>
