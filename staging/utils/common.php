<?php
    header("Content-Type: text/html; charset=UTF-8");
    $host = "127.0.0.1";
    $id = "root";
    $pw = "";
    $db = "acs";
    $db_conn = mysqli_connect($host, $id, $pw, $db);
    if (!$db_conn) {
        // 연결 오류가 발생하면 커스텀 오류 페이지로 리디렉션
        header("Location: custom_error_page.php");
        exit();
    }
?>