<?php
    session_start();
    include "./utils/common.php";
    if(!isset($_SESSION['login'])){
        echo "<script>alert('로그인 후 이용 가능합니다.');window.location.href='./login/user_login.php';</script>";
        exit;
    }
    $userhash = $_SESSION['login'];
    $query = "SELECT * FROM users WHERE hash = '$userhash'";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    $userid = isset($row['id']) ? $row['id'] : '';
    if ($userid == ''){
        echo "<script>alert('비정상적인 접근입니다.');history.back(-1);</script>";
        exit;
    }

    $content = isset($_POST['review']) ? $_POST['review'] : '';
    if ($content == '') {
        echo "<script>alert('내용이 비어있습니다.');history.back(-1);</script>";
        exit;
    }
    
    $query = "INSERT INTO review (content, id) VALUES ('$content', '$userid')";
    $result = $db_conn->query($query);
    if($result){
        echo "<script>alert('소중한 리뷰 고맙습니다.');window.location.href='./review.php';</script>";
        exit;
    }else {
        echo "<script>alert('리뷰 작성에 실패했습니다.');window.location.href='./review.php';</script>";
        exit;
    }
?>