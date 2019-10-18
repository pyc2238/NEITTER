<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap4 --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{ asset('data/icon/css/font-awesome.min.css') }}">

    <title>@lang('home/main.translator')</title>
</head>
<body>
    
    <div class="row">
        <div class="col" style="background-color:#ea314e; height:50px;">
            <p style="text-align:center;padding-top:1%"><img src="{{ asset("data/ProjectImages/master/NEITTER.png") }}"
                    alt="Logo" ondragstart="return false"></p>
        </div>
    </div>

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img style="width:7%" src="{{ asset('data/ProjectImages/master/papago.jpg') }}" alt="user">
                <h5 style="padding-top:1%;" class="modal-title" id="Modal-large-demo-label">
                    @lang('home/main.translator')</h5>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-bottom:2%;">
                    <div class="col" id="removeAllBox">
                        <span style="color:blue">@lang('home/main.recode_notice')</span>
                        <button id="recodeAllRemoveBtn" onclick="sendAllData()" style="display:inline-block;cursor:pointer; margin-right:2%;" class="float-right"  type="button">@lang('home/main.recode_all_delete')</button>
                    </div>
                </div>
                
                <div id="translationDiv" class="row">
                    <div class="col">
                        <textarea class="form-control" id="translationBox" rows="10" style="resize: none;"
                            name="translationText" autocomplete=off placeholder="@lang('home/main.translation_notice')"></textarea>
                    </div>

                    <div class="col">
                        <textarea class="form-control" id="translationResBox" rows="10" style="resize: none;"
                            name="translationResText" autocomplete=off></textarea>
                    </div>
                </div>

                <div id="recodeDiv" class="row" style="margin-bottom:1%;">
                    <div class="col" style="overflow-y:scroll; height:243px;">
                        <table class="table table-hover">
                            <thead>
                            </thead>
                            <tbody id="transRecords">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <button style="display:inline-block;margin-left:2%;" id="translationBtn" type="button"
                        class="btn btn-primary">@lang('home/main.translation')</button>
                    <button style="display:inline-block" id="translationRecodeBtn" type="button"
                        class="btn btn-success">@lang('home/main.translationRecord')</button>
                    <button style="display:inline-block" id="copy-url" type="button" title="copy"
                        class="btn btn-success"><i class="fa fa-copy"></i></button>
                    <button style="display:inline-block; margin-bottom:2%;margin-right:2%;" onclick="window.close();" type="button"
                        class="btn btn-danger float-right"
                        data-dismiss="modal">@lang('auth/profile.model_check')</button>
                </div>

            </div>
        </div>
    </div>


</body>

    <script>
        $(document).ready(function () {
            //윈도우 로드시 번역 div를 보여주고 번역기록 div를 숨긴다.
            $('#translationDiv').show();
            $('#recodeDiv').hide();
            $('#removeAllBox').hide();
            
            //번역기록 클릭 시 번역 기록 데이터를 불러온다.
            $('#translationRecodeBtn').click(function () {
                if($(".traRecods").length){
                    $(".traRecods").remove();
                }
                $.ajax({
                    url: '{{route('translation.recodes')}}',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        data.forEach((rec) => {
                            document.querySelector('#transRecords').innerHTML +=
                                `
                    <tr class="traRecods">
                        <td class="recode${rec.id}" id="recodeValue-${rec.id}" style="display:none">${rec.id}</td>
                        <td class="recode${rec.id}">${rec.korean}</td>
                        <td class="recode${rec.id}">${rec.japanese}</td>
                        <td class="recode${rec.id}"><button id="recodeRemoveBtn-${rec.id}" onclick="sendData(${rec.id})" type="button" class="float-right" style="padding-left:3%;padding-right:3%;cursor:pointer;">@lang('home/main.recode_delete')</button></td>
                    </tr>

                    `
                        })

                    },
                    error: function () {
                        alert("error!!!!");
                    }
                });
                $("#translationBox").val('');
                $("#translationResBox").val('');
                $('#translationDiv').hide();
                $('#recodeDiv').show();
                $('#removeAllBox').show();
            });

            //번역 결과 복사
            $( '#copy-url' ).click(
                function() {
                var urlbox = document.getElementById( 'translationResBox' );
                urlbox.select();
                document.execCommand( 'Copy' );
        }
    );

        });
        
        //번역기록 삭제
        function sendData(id) {
            $.ajax({
                url: '{{route('translation.recode.delete')}}',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (data) {
                    //삭제된 엘리먼트 제거
                    $(".recode"+id).remove();

                },
                error: function () {
                    alert("error!!!!");
                }
            });
        }


        //전체 번역기록 삭제
        function sendAllData() {
            $.ajax({
                url: '{{route('translation.recode.allDelete')}}',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    },
                success: function (data) {
                    //삭제된 엘리먼트 제거
                    $(".traRecods").remove();

                },
                error: function () {
                    alert("error!!!!");
                }
            });
        }


        //번역 div가 hide일 때 번역 버튼 클릭시 번역기록 div를 숨기고 변역 div를 보여준다.
        if ($('#translationDiv').hide()) {
            $('#translationBtn').click(function () {
                $('#recodeDiv').hide();
                $('#removeAllBox').hide();
                $('#translationDiv').show();
            });
        }


        // 번역 버튼 translation ajax 
        $("#translationBtn").click(function () {
            $.ajax({
                url: '{{route('translation')}}',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    'material': $('#translationBox').val(),
                },
                success: function (data) {

                    $("#translationResBox").val(data);

                },
                error: function () {
                    alert("error!!!!");
                }
            });
        });

        //번역창 지우기 버튼 클릭시
        $("#closeBtn").click(function () {
            $("#translationBox").val('');
            $("#translationResBox").val('');
            $('#translationDiv').show();
            $('#recodeDiv').hide();
        });

    </script>

</html>






