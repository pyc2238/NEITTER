// communiy.blade.php
function searchBtn() {
    var searchValue = document.getElementById('inputState').value;
    var search = document.getElementById('inputText').value;

    var url = '/search/' + search + '/' + searchValue;

    location.href = url;
}

function enterkey() {
    if (window.event.keyCode == 13) {

        var searchValue = document.getElementById('inputState').value;
        var search = document.getElementById('inputText').value;

        var url = '/search/' + search + '/' + searchValue;

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
