// communiy.blade.php

function searchBtn(page) {
    var searchValue = document.getElementById('inputState').value;
    var search = document.getElementById('inputText').value;
    page = 1;
    var url = 'community?search=' + search + '&where=' + searchValue+'&page='+page;
   
    location.href = url;
}

function enterkey(page) {
    if (window.event.keyCode == 13) {

        var searchValue = document.getElementById('inputState').value;
        var search = document.getElementById('inputText').value;
        page = 1;
         var url = 'community?search=' + search + '&where=' + searchValue+'&page='+page;

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
    if (choice) {
        location.href = "community_delete_comment.php?id=" + commentNum + "&page=" + page;
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


$(function() {  
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {    //스크롤이  500px보다 커질 때
            $('#MOVE_TOP_BTN').fadeIn();
        } else {
            $('#MOVE_TOP_BTN').fadeOut();
        }
    });
    
    $("#MOVE_TOP_BTN").click(function() {
        $('html, body').animate({
            scrollTop : 0
        }, 400);
        return false;
    });
});

  $(function() {  
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {    //스크롤이  200px보다 커질 때
            $('#MOVE_COMMENT_BTN').fadeIn();
        } else {
            $('#MOVE_COMMENT_BTN').fadeOut();
        }
    });
});
function fnMove(){
 var offset = $("#commentBox").offset();
$('html, body').animate({scrollTop : offset.top}, 400);
}