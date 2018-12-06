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
