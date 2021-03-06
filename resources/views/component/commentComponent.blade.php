<script>
        (function () {
            var updateTextArea = "";
            updateTextArea = "<div class='row'>"
                +"<div class='col' id='comments{{ $comment->id }}'>"
                    +"<form class='form-group' action='{{route('community.comment.update',['boardNum'=>$community->num,'search'=>$search,'where'=>$where,'page'=>$page,'commentId'=>$comment->id])}}' method='post'>"
                        +'@csrf'
                        +'@method("put")'
                        +"<input type='hidden' name='id' value='{{$comment->id}}'>"
                        +"<div class='row'>"
                            +"<div class='col-10'>"
                                +"<textarea name='comment' class='form-control' style='resize: none;' id='commentText' rows='3' required> {{$comment->content}}</textarea>"
                            +"</div>"
                            + "<div class='col-2'><input type='submit' class='btn btn-outline-danger' value='@lang('home/component/commentComponent.modify')' id='commentWrite'>"
                                +"<i id='closeBtn{{$comment->id}}' title='close' class='float-right pnt' style='cursor:pointer;'>x</i>"
                            +"</div>"
                    +"</form>"
                +"</div>"
            +"</div>";
            $("#updateBtn{{$comment->id}}").on('click',function(){   //updateBtn클릭시
                if($('#comments{{$comment->id}}').length == 0){  //comments가 생성되지않았다면
                    $("#comment{{$comment->id}}").append(updateTextArea);    //comment라는 id를 가진 dom의 안에 생성
                    $("#closeBtn{{$comment->id}}").on('click',function(){    // closeBtn클릭시 
                    $('#comments{{$comment->id}}').remove(); //comments 취소
                    });
                }else {
                    return ;
                } 
            });
                
        })();
    </script>
        <script>    
            (function () {
            var updateTextArea = "";
            updateTextArea = "<div class='row'>"
            +"<div class='col' id='translationComments{{$comment->id}}'>"
                    +"<div class='form-group'>" 
                        +"<div class='row'>"
                            +"<div class='col-11'>"
                                +"<textarea name='comment' class='form-control' style='resize: none; background-color:#f6faf8;' id='commentText' rows='1' readonly required> {{$comment->translation}}</textarea>"
                            +"</div>"
                            + "<div class='col-1'>"
                            +"<i id='translationCloseBtn{{$comment->id}}' title='닫기' class='pnt' style='cursor:pointer;'>x</i>"
                        +"</div>"
                    +"</div>"            
                +"</div>"
            +"</div>";
            $("#translation{{ $comment->id }}").on('click',function(){   //updateBtn클릭시
                if($('#translationComments{{ $comment->id }}').length == 0){  //comments가 생성되지않았다면
                    $("#comment{{ $comment->id }}").append(updateTextArea);    //comment라는 id를 가진 dom의 안에 생성
                    $("#translationCloseBtn{{ $comment->id }}").on('click',function(){    // closeBtn클릭시 
                    $('#translationComments{{ $comment->id }}').remove(); //comments 취소
                    });
                }else {
                    return ;
                } 
            });
                
        })();
    </script>
 