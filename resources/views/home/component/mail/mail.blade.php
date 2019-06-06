<html>

<head>
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
        <span id="R">수신함</span>
        <span id="S">송신함</span>
        <a href="" id="write"><span>새로작성</span></a>
        <span id="friend">친구관리</span>
    </div>
</body>

</html>

<style>
    #write:visited{
        border:1px solid blue;
    }
</style>
