// communiy.blade.php

function searchBtn(name) {
    var searchValue = document.getElementById('inputState').value;
    var search = document.getElementById('inputText').value;
    var page = 1;
    var url = name+'?search=' + search + '&where=' + searchValue + '&page=' + page;

    location.href = url;
}

function enterkey(name) {
    if (window.event.keyCode == 13) {

        var searchValue = document.getElementById('inputState').value;
        var search = document.getElementById('inputText').value;
        var page = 1;
        var url = name+'?search=' + search + '&where=' + searchValue + '&page=' + page;

        location.href = url;
    }
}


function choice(num, pages) {
    var choice = confirm("해당 게시글을 삭제하시겠습니까?");
    if (choice) {
        location.href = "/deleteRecord/" + num + '/' + pages;
    }
}


// view.blade.php
function choiceComment(commentNum, page) {
    var choice = confirm("해당 댓글을 삭제하시겠습니까?");
    if (!page) {
        page = 1;
    }
    if (choice) {
        location.href = "/comment/delete?id=" + commentNum + "&page=" + page;
    }
}




function choice(num, pages) {
    var choice = confirm("해당 게시글을 삭제하시겠습니까?");
    if (choice) {
        location.href = "/deleteRecord/" + num + '/' + pages;
    }
}


$(document).on("click", ".translation > button", function () {
    if ($(this).next().css("display") == "none") {
        $(this).next().show();
    } else {
        $(this).next().hide();
    }
});




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

//게시판 핫한 게시물 네비
$(function () {
    $('#hot-hits').click(function () { 
        $('#hot-hits-box').css('display');  
        $('#hot-hits').css('color','orange'); 
        $('#hot-hits-box').show(); 
  

        $('#hot-commend-box').hide();
        $('#hot-commend-box').css("display", "none");
        $('#hot-commend').css('color','white'); 
        $('#hot-comment-box').hide(); 
        $('#hot-comment-box').css("display", "none");
        $('#hot-comment').css('color','white'); 
    });

    $('#hot-commend').click(function () { 
        $('#hot-commend-box').css('display');
        $('#hot-commend').css('color','orange'); 

        $('#hot-commend-box').show(); 
        $('#hot-hits-box').hide(); 
        $('#hot-hits-box').css("display", "none");
        $('#hot-hits').css('color','white'); 
        $('#hot-comment-box').hide(); 
        $('#hot-comment-box').css("display", "none");
        $('#hot-comment').css('color','white');
    });


    $('#hot-comment').click(function () { 
        $('#hot-comment-box').css('display');  
        $('#hot-comment').css('color','orange'); 
        $('#hot-comment-box').show(); 

        $('#hot-hits-box').hide(); 
        $('#hot-hits-box').css("display", "none");
        $('#hot-hits').css('color','white'); 
        $('#hot-commend-box').hide();
        $('#hot-commend-box').css("display", "none");
        $('#hot-commend').css('color','white'); 
        
    });

});

