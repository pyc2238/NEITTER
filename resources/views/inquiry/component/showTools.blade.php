@include('community.component.showDestoryModal')

<div class='container'>
    <div class="text-center" id="tool" style="margin-top:1%;">
        <form action="{{route('inquiry.increaseCommend',['boardNum'=>$inquiry->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('put')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="commend">
                <h2><i class="fa fa-star"></i></h2>
            </button>
        </form>
        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="modify" onclick="location.href='{{route('inquiry.edit',['boardNum'=>$inquiry->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-pencil"></i></h2>
        </button>
        <form id="destory-form" action="{{route('inquiry.destroy',['boardNum'=>$inquiry->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('delete')
            <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="delete" data-toggle="modal"
                data-target="#Modal-choice">
                <h2><i class="fa fa-trash"></i></h2>
            </button>
        </form>

        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="list" onclick="location.href='{{route('inquiry.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-list"></i></h2>
        </button>

    </div>
    @if(Auth::check())
        @if(Auth::user()->admin == 1)
        <div class="row">
            <div class="col" id="comments">
                <form class="form-group" action="{{route('inquiry.comment',['boardNum'=>$inquiry->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
                    method='post'>
                    @csrf
                    <div class="row">
                        <div class="col-10"><textarea name="comment" class='form-control' style='resize: none;' id='commentText'
                                rows="3" placeholder='@lang('inquiry/component/showTable.comment_notice')' required></textarea></div>
                        <div class="col-2"><input type="submit" class="btn btn-outline-info" value='@lang('inquiry/component/showTable.comment_write')'
                                id='commentWrite'></div>
                </form>
            </div>
        </div>
        @endif
    </div>
@endif
</div>
