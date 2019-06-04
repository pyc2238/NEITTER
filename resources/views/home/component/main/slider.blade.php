@section('main_slider')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection

<div class="main-slider w3-content w3-display-container">
    <a href=""><img class="mySlides"
        src="http://neitter.s3-ap-northeast-2.amazonaws.com/users_penpal_photo/7af8c6f6-253b-447f-9fdf-274b03037ab6subjectImg.jpg"
        style="width:100%"></a>
    <a href=""><img class="mySlides"
        src="http://neitter.s3-ap-northeast-2.amazonaws.com/users_penpal_photo/ca557505-2927-409c-a049-ef2a17dc2070KakaoTalk_20181202_043105760.jpg"
        style="width:100%"></a>
    <a href=""><img class="mySlides"
        src="http://neitter.s3-ap-northeast-2.amazonaws.com/users_penpal_photo/a16a9e10-7c2f-44bc-9ee2-8843ae72fbc3umr.jpg"
        style="width:100%"></a>
    <a href=""><img class="mySlides"
        src="http://neitter.s3-ap-northeast-2.amazonaws.com/users_penpal_photo/ca557505-2927-409c-a049-ef2a17dc2070KakaoTalk_20181202_043105760.jpg"
        style="width:100%"></a>
    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
        <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
        <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
    </div>
</div>


<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }

    //3초 자동넘김 시간을 설정한다.
    setInterval(() => {
        plusDivs(1)
    }, 3000)

</script>
