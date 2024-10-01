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
        if($user_id == 'CATCHMEIFYOUCAN'){
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
            exit;
        }
        # 정규표현식 범위 내에 없는 문자가 아이디로 삽입될 시 경고 문구 출력
        if((preg_match("/^[0-9a-zA-Z]*$/", $user_id) == 0)){
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
            exit;
        }
        # 구분 값을 통한 인젝션 공격 차단을 위한 검증 절차
        $gubun = strtolower($gubun);
        if ($gubun == 'user'){
            # SQLi 공격 방어를 위한 프리페어 스테이트먼트 처리
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = ($result && $result->num_rows) ? $result->num_rows : 0;
            $row = $result->fetch_assoc();
            $real_password = isset($row['password']) ? $row['password'] : '';
            if($real_password == $user_pw){
                $_SESSION['id'] = $user_id;
                $_SESSION['login'] = hash("sha256",$user_id); // 세션 변수 설정
                header("Location: ../index.php"); // 대시보드 페이지로 리디렉션
                exit(); // 스크립트 실행 중지
            }else{
                echo "<script>alert('아이디 혹은 패스워드가 일치하지 않습니다.');history.back(-1)</script>";
                exit;
            }
        }else if($gubun == 'admin'){
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
            exit;
        }else {
            echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
            exit;
        }
    }
?>
