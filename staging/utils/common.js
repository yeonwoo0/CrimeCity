// review.php에 적용한 코드 : 뒤로가기 버튼 누를 시 홈으로 이동
const btn_back = document.querySelector('#btn_back');
btn_back.addEventListener('click', ()=>{
    window.location.href = './index.php';
})

// index.php에 적용한 코드 : 홈 배너가 2.5초마다 캐러셀 슬라이딩됨
const btn_history = document.querySelector('#history');
const history_modal = document.querySelector('#history-show');
document.addEventListener("DOMContentLoaded", function() {
    const slide_container = document.querySelector('.slide-container');
    let i = 0;
    function repeat() {
        setTimeout(() => {
            slide_container.style.transform = `translateX(${-i * 70}vw)`;
            i++;
            if (i > 2) i = 0;
            repeat(); 
        }, 2500);
    }
    repeat(); 
});

// register.php에 적용한 코드 : 패스워드 입력값 겁증(registerAction.php에서 이중 검증함)
const btn_create = document.querySelector('#btn_create');
btn_create.addEventListener('click', ()=>{
    const upw1 = document.querySelector('#upw').value;
    const upw2 = document.querySelector('#upw2').value;
    if(upw1 == upw2){
        window.location.href = "../index.php";
    }else if(upw1.length > 14 || upw2.length > 14){
        alert('패스워드는 14글자 이내로 작성해주세요');
        event.preventDefault(); // 양식 제출 중단
    }
    else {
        alert('패스워드를 확인해주세요.');
        event.preventDefault(); // 양식 제출 중단
    }
})

//adminWrite.php에서 사용된 코드 : 관리자 페이지에서만 사용가능한 스크립트 파일 업로드 기능
function upload(){
    window.open(editAction.php, '', 'scrollbars=no,width=500, height=500');
    elementId = id;
}

// write.php에서 사용된 코드 : 제목과 본문 입력 검사 및 뒤로가기 버튼 기능
document.addEventListener("DOMContentLoaded", function() {
    const back = document.querySelector('#back');
    back.addEventListener('click', () => {
        history.back(-1);
    });
}); // edit에서 사용한 코드와 btn_submit 이름이 겹쳐서 1로 붙여서 표기
const btn_submit1 = document.querySelector('#write');
btn_submit.addEventListener("click", (e)=>{
    const title = document.querySelector('#title');
    const content = document.querySelector('.text-box');
    if(title.value == '') {
        alert('제목을 입력하세요.');
        title.focus()
        e.preventDefault();
        return
    }
    else if(content.value == ''){
        alert('본문을 입력하세요.');
        content.focus();
        e.preventDefault();
        return
    }
})

// adminLogin.php에서 사용된 코드 : 관리자 계정으로 로그인할때 아이디 입력 검증
const btn_admin = document.querySelector('#btn_admin');
btn_create.addEventListener('click', ()=>{
    const adminid = document.querySelector('#adminid').value;
    const adminpw = document.querySelector('#adminpw').value;
    if(adminid == 'CATCHMEIFYOUCAN'){
        window.location.href = 'adminLoginAction.php';
    }
})

//view.php에서 사용된 코드 : 삭제,수정 버튼이 클릭될 때 버튼 글자가 변경됨
// 이벤트 핸들링을 위한 변수 선언
const list_btn = document.querySelector('#list_btn');
const edit_btn = document.querySelector('#edit_btn');
const modal_text = document.querySelector('#modal-text');
const delete_btn = document.querySelector('#delete_btn');
const modal = document.querySelector('#modal');
const modal_delete = document.querySelector('#modal-delete');
const modal_cancel = document.querySelector('#modal-cancel');

// 모달창이 띄워진 후 취소 버튼을 누르면 다시 지워주는 기능
modal_cancel.addEventListener('click', ()=>{
    modal.classList.remove('show-modal')
})
// list 버튼을 누르면 board 페이지로 전환
list_btn.addEventListener('click', ()=>{
    window.location.href = './board.php';
});
// 삭제를 눌렀을 때 모달창의 버튼 글자를 삭제로 변경해주고 deleteAction.php로 이동
delete_btn.addEventListener('click', () => {
    modal_text.textContent = "삭제";
    modal.classList.add('show-modal');
    modal_text.addEventListener('click', ()=>{
    const delPassword = document.querySelector('#inputPass').value;
    window.location.href = `./deleteAction.php?idx=<?=$row['idx']?>&inputPass=${delPassword}`;
})
});
// 수정을 눌렀을 때 모달창의 버튼 글자를 수정으로 변경해주고 editAction.php로 이동
edit_btn.addEventListener('click', ()=>{
    modal_text.textContent = '수정';
    modal.classList.add('show-modal');
    modal_text.addEventListener('click', ()=>{
        const editPassword = document.querySelector('#inputPass').value;
        window.location.href = `./edit.php?idx=<?=$row['idx']?>&inputPass=${editPassword}`;
    })
})

//edit.php에서 사용한 코드 
document.addEventListener("DOMContentLoaded", function() {
    const back = document.querySelector('#back');
    back.addEventListener('click', () => {
        window.location.href = "./board.php";
    });
});
const btn_submit = document.querySelector('#write');
btn_submit.addEventListener("click", (e)=>{
    const title = document.querySelector('#title');
    const content = document.querySelector('.text-box');
    if(title.value == '') {
        alert('제목을 입력하세요.');
        title.focus()
        e.preventDefault();
        return
    }
    else if(content.value == ''){
        alert('본문을 입력하세요.');
        content.focus();
        e.preventDefault();
        return
    }
})

//board.php에서 사용한 코드
function redirectToWritePage() {
    window.location.href = "./write.php";
}