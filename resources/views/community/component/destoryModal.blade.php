<div class="modal fade" id="Modal-choice{{$msg->num}}" tabindex="-1" role="dialog" aria-labelledby="Modal-small"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-small">@lang('community/component/indexModal.model_subject')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-circle">@lang('community/component/indexModal.model_body')</i>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="event.preventDefault();
                    document.getElementById('destory-form{{$msg->num}}').submit();">@lang('community/component/indexModal.model_destory')</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('community/component/indexModal.model_check')</button>
            </div>
        </div>
    </div>
</div>
