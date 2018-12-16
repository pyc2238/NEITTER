
//닉네임 중복 체크
function checkName() {

    // 만들 팝업창 좌우 크기의 1/2 만큼 보정값으로 빼주었음
    var popupX = (window.screen.width / 2) - (345 / 2);
    // 만들 팝업창 상하 크기의 1/2 만큼 보정값으로 빼주었음
    var popupY = (window.screen.height / 2) - (300 / 2);

    var name = document.getElementById("name").value; //uid의 id값을 가진 elements객체의 값을 userid변수에 저장
    if (name) {
        url = "check-name?name=" + name; //userid의 값을 joinCheck.php에 넘겨준다.
        //팝업창 설정
        window.open(url, "chkid", 'status=no, width=300, height=100, left=' + popupX +
            ', top=' + popupY + ', screenX=' + popupX + ', screenY= ' + popupY);
    } else {
        alert("아이디를 입력하세요");
    }
}


// login_form.blade.php
function show_Banner(num) {
    for (i = 0; i < 25; i++) {
        if (num == i) {
            Rand_Banner[i].style.dispaly = "";
        } else {
            Rand_Banner[i].style.display = "none";
        }
    }
}

function findCheckId(chkbox) {
    if (chkbox.checked == true) {
            document.getElementById("password").readOnly = true;
         document.getElementById("password").value = "";
    } else {
         document.getElementById("password").readOnly = false;

    }
}
