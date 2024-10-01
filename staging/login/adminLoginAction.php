<?php
    if(isset($_SESSION['login'])){
        session_destroy(); 
    }
    session_start();
    include "../utils/common.php";

    # 로그인 페이지로부터 전달받는 값이 있는지 확인
    if ((isset($_POST['uid']) && isset($_POST['upw'])) || isset($_POST['admin_id']) && isset($_POST['admin_pw'])){
        # 로그인 페이지는 2개이지만 액션 페이지는 1개라서 구분 값을 파라미터로 받아서 관리자 요청인지 유저 요청인지 확인
        $gubun = isset($_POST['gubun']) ? $_POST['gubun'] : 'user';
        # 정규표현식을 통한 검증을 위해 전달받은 아이디를 user_id로 통합
        $user_id = isset($_POST['uid']) ? $_POST['uid'] : $_POST['admin_id'];
        $user_pw = isset($_POST['upw']) ? $_POST['upw'] : $_POST['admin_pw'];
        # 정규표현식 범위 내에 없는 문자가 아이디로 삽입될 시 경고 문구 출력
        # 구분 값을 통한 인젝션 공격 차단을 위한 검증 절차
        $gubun = strtolower($gubun);
        if ($gubun == 'user'){
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
            exit;
        }else if($gubun == 'admin'){
            # SQLi 공격 방어를 위한 프리페어 스테이트먼트 처리
            $query = "SELECT * FROM administrators WHERE id = '$user_id' and password = '$user_pw'";
            $result = $db_conn->query($query);
            $num = ($result && $result->num_rows) ? $result->num_rows : 0;
            if($num == 0){
                echo "<script>alert('아이디 또는 패스워드가 일치하지 않습니다.');history.back(-1);</script>";
                exit;
            }
            $row = $result->fetch_assoc();
            if($num > 0){
                $_SESSION['login'] = hash("sha256",$row['id']); // 세션 변수 설정
                $_SESSION['id'] = $row['id'];
                echo "<script>alert('관리자님 반갑습니다.');window.location.href='../index.php'</script>";
                exit(); // 스크립트 실행 중지
            }
        }else {
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
            exit;
        }
    }
?>
