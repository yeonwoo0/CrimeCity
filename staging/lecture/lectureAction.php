<?php
session_start();
include "../utils/common.php";

$lecture = isset($_GET['lecture']) ? $_GET['lecture'] : '';
$gubun = isset($_GET['gubun']) ? $_GET['gubun'] : '';

if($lecture == 'web'){
    $cookie = $gubun;
    setcookie('lecture', $lecture, time() + 3600, "./lectureView.php");
    setcookie('gubun', $gubun, time() + 3600, "./lectureView.php");
}else if($lecture == 'mobile'){
    $cookie = $gubun;
    setcookie('lecture', $lecture, time() + 3600, "./lectureView.php");
    setcookie('gubun', $gubun, time() + 3600, "./lectureView.php");
}else if($lecture == 'system'){
    $cookie = $gubun;
    setcookie('lecture', $lecture, time() + 3600, "./lectureView.php");
    setcookie('gubun', $gubun, time() + 3600, "./lectureView.php");
}

// lecture.php 페이지로 리다이렉트
header("Location: lectureView.php");
exit;
?>
