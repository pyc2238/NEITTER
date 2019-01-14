<div class='container'>
    <div class="text-center" id="tool" style="margin-top:1%;">
        @if(Auth::check())
            @if(Auth::user()->admin == 1)
                <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="modify" onclick="location.href='{{route('notice.edit',['boardNum'=>$notice->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
                    <h2><i class="fa fa-pencil"></i></h2>
                </button>
                <form action="{{route('notice.destroy',['boardNum'=>$notice->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
                    method="post" style="display:inline-block">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="delete">
                        <h2><i class="fa fa-trash"></i></h2>
                    </button>
                </form>
            @endif
        @endif
        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="list" onclick="location.href='{{route('notice.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-list"></i></h2>
        </button>

    </div>

</div>
