<?php
    session_start();
    if(isset($_SESSION['login'])){
        session_destroy(); 
        echo "<script>alert('로그아웃 되었습니다.');history.back(-1);</script>";
    }else{
        echo "<script>alert('로그인이 되어있지 않습니다.');history.back(-1);</script>";
    }

?>