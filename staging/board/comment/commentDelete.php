<?php
    session_start();
    include "../../utils/common.php";

    $idx = isset($_GET['idx']) ? $_GET['idx'] : 0;
    if(preg_match("/^[0-9]*$/", $idx) == 0){
        echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
        exit;
    }else if(!isset($_SESSION['login'])){
        echo "<script>alert('로그인 후 이용가능합니다.');history.back(-1)</script>";
        exit;
    }

    $query = "SELECT * FROM comments WHERE idx = $idx";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    
    if($row['id'] != $_SESSION['id']){
        echo "<script>alert('작성자가 일치하지 않습니다.');history.back(-1)</script>";
        exit;
    }

    $query = "DELETE FROM comments WHERE idx = $idx";
    $result = $db_conn->query($query);
    if($result){
        echo "<script>alert('댓글이 삭제되었습니다.');history.back(-1)</script>";
        exit;
    }else{
        echo "<script>alert('댓글 삭제에 실패했습니다.');history.back(-1)</script>";
        exit;
    }
    $db_conn->close();
?>