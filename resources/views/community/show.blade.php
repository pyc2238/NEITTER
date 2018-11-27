@extends('layouts.app')
@section('title')
게시글
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('/css/community.css')}}">


<a id="MOVE_TOP_BTN" href="#"><img src="{{asset('/data/ProjectImages/community/top.png')}}" alt="back-to-top"></a>
<a id="MOVE_COMMENT_BTN" href="#commentBox" style='color:red' onclick='fnMove()'><img src="{{asset('/data/ProjectImages/community/comment.png')}}"
        alt="back-to-comment"></a>
<div class="col">
    <br>
    <h4><img src="{{$community->country}}" alt="국적">&nbsp;
        {{$community->title}}
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

    <div class="col translation float-right">
        <button class='btn btn-warning'><b>일본어로 보기</b></button>
        <div style="display:none; border:1px dashed gray;">
            <div>
                <h4> {{$translationTitle}}</h4>
                <br>
                <br>
                <br>
                <br>
                {!!$translationContent!!}
            </div>
        </div>
    </div>


    <div class="col text-center" style="margin-top:400px">

        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="추천" onclick="location.href=''">
            <h2><i class="fa fa-star"></i></h2>
        </button>
        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="수정" onclick="location.href='{{route('community.edit',['boardNum'=>$community->num,'page'=>$page])}}'">
            <h2><i class="fa fa-pencil"></i></h2>
        </button>
        <form style="display:inline-block" action="{{route('community.destroy',['boardNum'=>$community->num,'page'=>$page])}}"
            method="post">
            @csrf
            @method('delete')
            <button class="btn btn-outline-warning" id="sombra_fija" type="submit" title="삭제">
                <h2><i class="fa fa-trash"></i></h2>
            </button>
        </form>

        <button class="btn btn-outline-warning" id="sombra_fija" type="button" title="목록" onclick="location.href='{{route('community.index',['page'=>$page])}}'">
            <h2><i class="fa fa-list"></i></h2>
        </button>
    </div>
</div>

<div class="row" style='margin-top:5%;'>
    <div class="col">
        
    </div>
    <div class="col-12">
        <div class="col commentBoxfirst" style='height:27px'>

            <p style='font-size:15px; display:inline-block;'>img>
                작성자
            </p>
            <p class='float-right' style='font-size:15px; '>
                작성시간
                작성자
                <i class="fa fa-edit updateBtn pnt" style='color:blue' title='수정'></i>
                <i class="fa fa-trash pnt" style='color:red' title='삭제'></i>
                <i class="fa fa-exchange pnt" style='color:#06f890' title='번역'></i>

            </p>

        </div>

        <div class="w-100"></div>

        <div class="col commentBoxsecound">
            <p>
                내용
            </p>

        </div>
    </div>
    <div class="col">

    </div>
</div>




@endsection
