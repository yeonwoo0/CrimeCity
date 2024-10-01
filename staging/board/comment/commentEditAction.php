<?php
    session_start();
    include "../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    $idx = isset($_POST['idx']) ? $_POST['idx'] : 0;
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $boardidx = isset($_POST['boardidx']) ? $_POST['boardidx'] : 0;

    if(preg_match("/^[0-9]*$/", $idx) == 0){
        echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
        exit;
    }else if($idx == 0){
        echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
        exit;
    }
    $text = str_replace("\r\n", "<br>", $text);

    $query = "UPDATE comments SET comment_text=? WHERE idx = ?";
    $stmt = $db_conn->prepare($query);
    $stmt->bind_param("si", $text, $idx);
    $result = $stmt->execute();
    if($result){
        echo "<script>alert('댓글 수정이 완료되었습니다.');location.href='../view.php?idx={$boardidx}';</script>";
        exit;
    }else{
        echo "<script>alert('댓글 수정에 실패했습니다.');history.back(-1);</script>";
        exit;
    }
    $stmt->close();
    $db_conn->close();
?>