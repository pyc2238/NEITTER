<div class="modal fade" id="Modal-choice" tabindex="-1" role="dialog" aria-labelledby="Modal-small" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal-small">@lang('auth/profile.model_subject')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                </div>
                <div class="modal-body">
                        @lang('auth/profile.model_body')
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.href ='{{route('user.destroy')}}'">@lang('auth/profile.model_destory')</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('auth/profile.model_check')</button>
                </div>
            </div>
        </div>
    </div>