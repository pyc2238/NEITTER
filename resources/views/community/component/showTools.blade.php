<div class='container'>
    <div class="text-center" id="tool" style="margin-top:1%;">
        <form action="{{route('community.increaseCommend',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('put')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="commend">
                <h2><i class="fa fa-star"></i></h2>
            </button>
        </form>
        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="modify" onclick="location.href='{{route('community.edit',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-pencil"></i></h2>
        </button>
        <form action="{{route('community.destroy',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('delete')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="delete">
                <h2><i class="fa fa-trash"></i></h2>
            </button>
        </form>

        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="list" onclick="location.href='{{route('community.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-list"></i></h2>
        </button>

    </div>
    @if(Auth::check())
    <div class="row">
        <div class="col" id="comments">
            <form class="form-group" action="{{route('community.comment',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
                method='post'>
                @csrf
                <div class="row">
                    <div class="col-10"><textarea name="comment" class='form-control' style='resize: none;' id='commentText'
                            rows="3" placeholder='@lang('community/component/showTable.comment_notice')' required></textarea></div>
                    <div class="col-2"><input type="submit" class="btn btn-outline-info" value='@lang('community/component/showTable.comment_write')' id='commentWrite'></div>
            </form>
        </div>
    </div>
</div>
@endif
</div>
