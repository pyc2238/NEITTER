<script>
        (function () {
            var updateTextArea = "";
            updateTextArea = "<div class='row'>"
                +"<div class='col' id='comments{{ $timeline->id }}'>"
                    +"<form class='form-group' action='{{ route('penpal.show.timeline.update',['id' => $timeline->id]) }}' method='post'>"
                        +'@csrf'
                        +"<input type='hidden' name='id' value='{{ $timeline->id }}'>"
                        +"<div class='row'>"
                            +"<div class='col-10'>"
                                +"<textarea name='comment' class='form-control' style='resize: none;' id='commentText' rows='3' required> {{$timeline->content}}</textarea>"
                            +"</div>"
                            + "<div class='col-2' style='width:100%'><i id='closeBtn{{ $timeline->id }}' title='close' class='float-right pnt' style='cursor:pointer;'>x</i><input type='submit' class='btn btn-outline-danger' value='@lang('home/component/commentComponent.modify')' id='commentWrite' style='width:100%;height:70%'>"
                              
                            +"</div>"
                    +"</form>"
                +"</div>"
            +"</div>";
            $('#updateBtn{{ $timeline->id }}').on('click',function(){   //updateBtn클릭시
                if($('#comments{{$timeline->id}}').length == 0){  //comments가 생성되지않았다면
                    $("#comment{{$timeline->id}}").append(updateTextArea);    //comment라는 id를 가진 dom의 안에 생성
                    $("#closeBtn{{$timeline->id}}").on('click',function(){    // closeBtn클릭시 
                    $('#comments{{$timeline->id}}').remove(); //comments 취소
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
            +"<div class='col' id='translationComments{{$timeline->id}}'>"
                    +"<div class='form-group'>" 
                        +"<div class='row'>"
                            +"<div class='col-11'>"
                                +"<textarea name='comment' class='form-control' style='resize: none; background-color:#f6faf8;' id='commentText' rows='1' readonly required> {{$timeline->translation}}</textarea>"
                            +"</div>"
                            + "<div class='col-1'>"
                            +"<i id='translationCloseBtn{{ $timeline->id }}' title='close' class='pnt' style='cursor:pointer;'>x</i>"
                        +"</div>"
                    +"</div>"            
                +"</div>"
            +"</div>";
            $("#translation{{ $timeline->id }}").on('click',function(){   //updateBtn클릭시
                if($('#translationComments{{ $timeline->id }}').length == 0){  //comments가 생성되지않았다면
                    $("#comment{{ $timeline->id }}").append(updateTextArea);    //comment라는 id를 가진 dom의 안에 생성
                    $("#translationCloseBtn{{ $timeline->id }}").on('click',function(){    // closeBtn클릭시 
                    $('#translationComments{{ $timeline->id }}').remove(); //comments 취소
                    });
                }else {
                    return ;
                } 
            });
                
        })();
    </script>