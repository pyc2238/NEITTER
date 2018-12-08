<!-- 알림모달 -->
<div class="modal fade" id="Modal-small-demo" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset('data/ProjectImages/master/notice.png')}}" alt="notice">
                <h5 class="modal-title" id="Modal-small-demo-label">알림</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <b class="text-center">{{Session::get('message')}}</b>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> OK </button>
            </div>
        </div>
    </div>
</div>