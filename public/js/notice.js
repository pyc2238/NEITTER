// communiy.blade.php

function noticeSearchBtn(page) {
    var searchValue = document.getElementById('inputState').value;
    var search = document.getElementById('inputText').value;
    page = 1;
    var url = 'notice?search=' + search + '&where=' + searchValue + '&page=' + page;

    location.href = url;
}

function noticeEnterkey(page) {
    if (window.event.keyCode == 13) {

        var searchValue = document.getElementById('inputState').value;
        var search = document.getElementById('inputText').value;
        page = 1;
        var url = 'notice?search=' + search + '&where=' + searchValue + '&page=' + page;

        location.href = url;
    }
}

function choice(num, pages) {
    var choice = confirm("해당 게시글을 삭제하시겠습니까?");
    if (choice) {
        location.href = "/deleteRecord/" + num + '/' + pages;
    }
}



function choice(num, pages) {
    var choice = confirm("해당 게시글을 삭제하시겠습니까?");
    if (choice) {
        location.href = "/deleteRecord/" + num + '/' + pages;
    }
}

$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) { //스크롤이  400px보다 커질 때
            $('#MOVE_TOP_BTN').fadeIn();
        } else {
            $('#MOVE_TOP_BTN').fadeOut();
        }
    });

    $("#MOVE_TOP_BTN").click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
});

$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) { //스크롤이  400px보다 커질 때
            $('#MOVE_COMMENT_BTN').fadeIn();
        } else {
            $('#MOVE_COMMENT_BTN').fadeOut();
        }
    });
});

$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) { //스크롤이  200px보다 커질 때
            $('#MOVE_WRITE_BTN').fadeIn();
        } else {
            $('#MOVE_WRITE_BTN').fadeOut();
        }
    });
});

function fnMove() {
    var offset = $("#tool").offset();
    $('html, body').animate({
        scrollTop: offset.top
    }, 400);
}

function searchDB(getDB) {
    var availableTags = [];
    var getDB = getDB;

    for (var i in getDB) {
        for (var j in getDB[i]) {
            availableTags.push([getDB[i][j]]);
        }
    }
    $(document).ready(function () {
        $("#inputText").autocomplete(availableTags, {
            matchContains: true,
            selectFirst: false
        });
    });
}
