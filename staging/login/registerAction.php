<?php
    session_start();
    include "../utils/common.php";

    $query = "SELECT id, count(*) num FROM users";
    $result = $db_conn->query($query);

    // 아이디와 패스워드 가져오기
    $userid = isset($_POST['uid']) ? $_POST['uid'] : '';
    $userpw = isset($_POST['upw']) ? $_POST['upw'] : '';
    // 아이디 유효성 검사
    // if (!preg_match("/^[0-9a-zA-Z]*$/", $userid)) {
    //     echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');window.location.href='../index.php'</script>";
    //     exit;
    // }else if (strlen($userpw) > 14) {
    //     echo "<script>alert('패스워드는 14글자 이내로 설정해주세요.');history.back(-1);</script>";
    //     exit;
    // }
    // 아이디 중복 검사
    if($userid){
        $query = "SELECT * FROM users WHERE id = '$userid'";
        $result = $db_conn->query($query);
        $flag = $result->num_rows;
        if($flag != 0){
            echo "<script>alert('이미 사용중인 ID입니다. 다른 ID를 사용해주세요');history.back(-1);</script>";
            exit;
        }
    }
    // 세션 할당을 위한 id 해싱
    $hashed_id = hash("sha256", $userid);
    // SQL 삽입 방지를 위해 prepared statement 사용
    $query = "INSERT INTO users (id, password, hash) VALUES ('$userid', '$userpw', '$hashed_id')";
    $result = $db_conn->query($query);
    // 결과 확인
    if ($result) {
        echo "<script>alert('{$userid}님 회원가입이 완료되었습니다.');window.location.href='../index.php'</script>";
    } else {
        echo "<script>alert('회원가입에 실패했습니다.');window.location.href='../index.php'</script>";
    }
    // 연결 닫기
    $db_conn->close();
?>
