<html>

<head>


    {{-- bootstrap4 --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- font-awesome --}}
    <link rel="stylesheet" href="{{ asset('data/icon/css/font-awesome.min.css') }}">



    {{-- mail.js --}}
    <script src="{{ asset('/js/mail.js') }}"></script>
    {{-- mail.css --}}
    <link href="{{ asset('css/mail.css') }}" rel="stylesheet">

    <div class="row">
        <div class="col" style="background-color:#ea314e; height:50px;">
            <p style="text-align:center;padding-top:1%"><img src="{{ asset("data/ProjectImages/master/NEITTER.png") }}"
                    alt="Logo" ondragstart="return false"></p>
        </div>
    </div>
</head>

<body>

    <p class="mail-title" id="inbox-myLetter">NEITTER-내 쪽지함</p>
    <hr>
    <div style="">
        <span><a href="" id="R">수신함</a></span>
        <span><a href="" id="S">송신함</a></span>
        <span><a href="" id="write">새로작성</a></span>
        <span><a href="" id="friend">친구관리</a></span>
    </div>



    {{-- @include('home.component.mail.component.receiveTable') --}}
    @include('home.component.mail.component.sendMail')




    <div class="row">
       
    </div>
    <div class="row">
        <div class="col text-center">
            <button class="btn btn-warning" type="button">창닫기</button>
        </div>
    </div>



</body>

</html>



<script>
    $(document).ready(function () {
        //최상단 체크박스 클릭
        $("#checkall").click(function () {
            //클릭되었으면
            if ($("#checkall").prop("checked")) {
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
                $("input[name=chk]").prop("checked", true);
                //클릭이 안되있으면
            } else {
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
                $("input[name=chk]").prop("checked", false);
            }
        })
    })

</script>
