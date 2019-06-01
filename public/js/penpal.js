
// index.blade.php 파일 리스트 형식 전환
$(function () {
    $('#penpal-image-view').click(function () { // ID가 penpal-image-view인 요소를 클릭하면
        $('#penpal-image-box').css('display'); // ID가 penpal-image-box인 요소의 display의 속성을 '대입'

        $('#penpal-image-box').show(); // ID가 penpal-image-box인 요소를 show();
        $('#penpal-list-box').hide(); // ID가 penpal-list-box인 요소를 hide();
        $('#penpal-list-box').css("display", "none");
    });


    $('#penpal-list-view').click(function () { // ID가 penpal-list-view인 요소를 클릭하면
        $('#penpal-list-box').css('display'); //  ID가 penpal-list-box인 요소의 display의 속성을 '대입' 
        $('#penpal-list-box').show(); // ID가 penpal-list-box인 요소를 show();

        $('#penpal-image-box').hide(); // ID가 penpal-image-box인 요소를 hide();
        $('#penpal-image-box').css("display", "none");
    });

});
