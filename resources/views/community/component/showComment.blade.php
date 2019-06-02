@if($commentCount != 0)
<div class='container' id='commentBox'>

    @foreach($comments as $comment)
   
    <div class="row" style='margin-top:1%;'>
        <div class="col">
        </div>
        <div class="col-12" style="margin-bottom:1%;">
            <div class="col commentBoxfirst" style='height:27px'>
                <p style='font-size:15px; display:inline-block;'>
                    @if($comment->country == 'ko')
                        <img src="{{asset('/data/ProjectImages/community/korea2.png')}}" alt="korea">
                    @else
                        <img src="{{asset('/data/ProjectImages/community/japan2.png')}}" alt="japan">
                    @endif
                    {{$comment->user->name}}
                </p>
                <p class='float-right' style='font-size:15px; '>
                    {{$comment->created_at}}
                    @if(Auth::check() && Auth::user()->name == $comment->user->name)
                        <i class="fa fa-edit updateBtn pnt" style='color:blue' title='update' id="updateBtn{{ $comment->id }}"></i>
                        <i class="fa fa-exchange  pnt" style='color:#06f890' title='translation' id='translation{{ $comment->id }}'></i>
                        <i class="fa fa-trash pnt" style='color:red' title='delete' onclick="location.href='{{route('community.comment.delete',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page,'commentId'=>$comment->id])}}'"></i>
                    @else
                        <i class="fa fa-exchange  pnt" style='color:#06f890' title='translation' id='translation{{ $comment->id }}'></i>
                    
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
