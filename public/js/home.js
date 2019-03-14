$(function () {
    $("#MOVE_TOP").click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
});

