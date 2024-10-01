<?php
    //유저로부터 입력받은 값을 htmlspecialchars 함수에 적용
    $exam1 = htmlspecialchars($exam1, ENT_QUOTES, 'UTF-8');
    $exam2 = htmlspecialchars($exam2, ENT_QUOTES, 'UTF-8');

    //SQLi에 대한 취약점은 정규표현식과 길이 제한을 사용합니다. 추가로 Prepare 역시 사용해줘야 합니다.
    $exam3 = str_replace(array("'", '"', "*", "(", ")", "<", ">", ";", "/", "\\"), "" , $password);
    if(preg_match("/^[0-9a-zA-Z]*$/", $id) == 0){
        echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
        exit;
    }else if(strlen($password) > 15){
        echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
        exit;
    }
?>