@extends('layouts.app')
@section('title')
게시판
@endsection

@section('content')
<div class="container content">
    <link rel="stylesheet" href="{{asset('/css/community.css')}}">

    <br>
    <h3>NEITTER-지식교류</h3>
    <hr>

    <div class="row">
        <div class='col'>
            <h5 style="font:bold; display:inline-block;" class='float-right'><i class="fa fa-calculator ">TOTAL :
            {{$count}}</i></h5>
        </div>

        <div class="container" style="height:95vh">

            <table class="table table-hover" style="table-layout:fixed">
                <thead>
                    <tr>
                        <th class="text-center" style="width:55px;">번호</th>
                        <th style="width:50px;"></th>
                        <th>제목</th>
                        <th style="width:150px;">글쓴이</th>
                        <th style="width:60px;">날짜</th>
                        <th class="text-right" style="width:70px;">조회</th>
                        <th class="text-right" style="width:70px;">추천</th>
                        <th class="text-right" style="width:150px;">수정/삭제</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($msgs as $msg)
                    <tr>
                        <td style="width:60px;">{{$msg->num}}</td>
                        <td style="width:50px;"><img src="{{$msg->country}}" alt="국적"></td>
                        <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href="{{route('community.show',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}">{{$msg->title}}</a></td>
                        
                        @if($where == 'writer')
                        <td style="width:150px;">{{$msg->name}}</td>
                        @else
                        <td style="width:150px;">{{$msg->user->name}}</td>
                        @endif
                        <td style="width:60px;">{{date('m-d',strtotime($msg->created_at))}}</td>
                        <td class="text-right" style="width:70px;">{{$msg->hits}}</td>
                        <td class="text-right" style="width:70px;">{{$msg->commend}}</td>
                        <td class="text-right" style="width:150px;">
                            <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" onclick="location.href='{{route('community.edit',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}'">
                                <h2><i class="fa fa-edit"></i></h2>
                            </button>
                            <form style="display:inline-block" action="{{route('community.destroy',['boardNum'=>$msg->num,'search'=>$search,'where'=>$where,'page'=>$page])}}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm">
                                    <h2><i class="fa fa-trash"></i></h2>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm" style='margin-top:5%;margin-bottom:3%'>
            <div class="input-group col-md-10">
                <select id="inputState" class="form-control" name="where" required>
                    <option selected value="title">제목</option>
                    <option value="writer">글쓴이</option>
                    <option value="content">내용</option>
                    <option value="titleAndcotent">제목+내용</option>
                </select>
                <input id="inputText" type="text" class="form-control" name="search" autocomplete=off onkeyup="enterkey(<?=$page?>);">
                <button class="button" onclick="searchBtn(<?=$page?>)">검색</button>
            </div>
        </div>
        @if($msgs->hasPages())
        <div class="col-4 pagination" style='margin-top:5%'>
            {{$msgs->appends(['search'=>$search,'where'=>$where])->links()}}
        </div>
        @endif

        <div class="col-4" style='margin-top:4%'>
            @if(Auth::check())
            <button class="btn btn-outline-warning float-right" type="button"><i class="fa fa-pencil" style="font-size:15px;"
                    onclick="location.href='{{route('community.create',['search'=>$search,'where'=>$where,'page'=>$page])}}'">글쓰기</i></button>
            @endif
            @if($search&& $where)
            <button class="btn btn-outline-warning  float-right" type="button" onclick="location.href='{{route('community.index')}}'"><i
                    class="fa fa-list" style="font-size:15px;">목록</i></button>
            @endif
        </div>

    </div>
    <!--end of row-->

</div>

@endsection
