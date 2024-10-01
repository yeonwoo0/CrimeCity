<?php
    session_start();
    include "../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    // 사용자로부터의 입력을 받습니다.
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $idx = isset($_POST['idx']) ? $_POST['idx'] : 0;
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

    // 입력 검증
    if(!isset($_SESSION['id'])){
        echo "<script>alert('로그인 후 이용가능합니다.');history.back(-1)</script>";
        exit;
    }else if($comment == ''){
        echo "<script>alert('빈칸이 존재합니다.');history.back(-1)</script>";
        exit;
    }
    
    $comment = str_replace("\r\n", "<br>", $comment);

    $query = "INSERT INTO comments (id, boardidx, comment_text) values('$id', '$idx', '$comment')";
    $result = $db_conn->query($query);
    $db_conn->close();
    echo "<script>self.location.href='../view.php?idx={$idx}';</script>";
?>
