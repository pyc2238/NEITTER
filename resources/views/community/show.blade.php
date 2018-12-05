@extends('layouts.app')
@section('title')
게시글
@endsection
@section('content')


<link rel="stylesheet" href="{{asset('/css/community.css')}}">


<a id="MOVE_TOP_BTN" href="#"><img src="{{asset('/data/ProjectImages/community/top.png')}}" alt="back-to-top"></a>
<a id="MOVE_COMMENT_BTN" href="#tool" onclick='fnMove()'><img src="{{asset('/data/ProjectImages/community/edit.png')}}"
        alt="back-to-comment"></a>

<div class="container content">

    <div class="col">
        <br>
        <h4><img src="{{$community->country}}" alt="국적">&nbsp;
            <b>{{$community->title}}</b>
        </h4>

        <hr>

        <table class="table">
            <thead>
                <tr style="height:1px">
                    <th style="width:80px">글쓴이</th>
                    <th>
                        {{$community->user->name}}
                    </th>
                    <th style="width:80px">작성일</th>
                    <th>
                        {{$community->created_at}}
                    </th>
                    <th style="width:58px;">조회</th>
                    <th>
                        {{$community->hits}}
                    </th>
                    <th style="width:58px;">추천</th>
                    <th>
                        {{$community->commend}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        {!!$community->content!!}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="col text-center" style="margin-top:40%;">

            <div class="col translation">
                <button class='btn btn-warning'><b>일본어로 보기</b></button>
                <div style="display:none; border:1px dashed gray;">
                    <div>
                        <br>
                        <h4> <b>{{$translationTitle}}</b></h4>
                        <br>
                        <br>
                        <br>
                        <br>
                        {!!$translationContent!!}
                    </div>
                </div>
            </div>

        </div>
    </div>



</div>


<div class='container'>
    <div class="text-center" id="tool" style="margin-top:1%;">
        <form action="{{route('community.increaseCommend',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('put')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="추천">
                <h2><i class="fa fa-star"></i></h2>
            </button>
        </form>
        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="수정" onclick="location.href='{{route('community.edit',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
            <h2><i class="fa fa-pencil"></i></h2>
        </button>
        <form action="{{route('community.destroy',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
            method="post" style="display:inline-block">
            @csrf
            @method('delete')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="삭제">
                <h2><i class="fa fa-trash"></i></h2>
            </button>
        </form>

        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="목록" onclick="location.href='{{route('community.index',['search'=>$search,'where'=>$where,'page'=>$page])}}'">
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
                            rows="3" placeholder='댓글을 작성하세요...' required></textarea></div>
                    <div class="col-2"><input type="submit" class="btn btn-outline-info" value='글쓰기' id='commentWrite'></div>
            </form>
        </div>
    </div>
</div>
@endif
</div>



@if($commentCount != 0)
<div class='container' id='commentBox'>
   
        @foreach($comments as $comment)
        <div class="row" style='margin-top:1%;'>
            <div class="col">
            </div>
            <div class="col-12" style="margin-bottom:1%;">
                <div class="col commentBoxfirst" style='height:27px'>
                    <p style='font-size:15px; display:inline-block;'><img src="{{$comment->country}}" alt="country">
                        {{$comment->user->name}}
                    </p>
                    <p class='float-right' style='font-size:15px; '>
                        {{$comment->created_at}}
                        @if(Auth::check() && Auth::user()->name == $comment->user->name)
                        <i class="fa fa-edit updateBtn pnt" style='color:blue' title='수정' id="updateBtn{{$comment->id}}"></i>
                    <i class="fa fa-trash pnt" style='color:red' title='삭제' onclick="location.href='{{route('community.comment.delete',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page,'commentId'=>$comment->id])}}'"></i>
                        @endif
                    </p>
                </div>
                <div class="col commentBoxsecound" id='comment{{$comment->id}}'>
                    <p>
                        {{$comment->content}}
                    </p>

                </div>
            </div>
        </div>

        @include('component.commentComponent')

        @endforeach
   
</div>
@endif


@endsection
