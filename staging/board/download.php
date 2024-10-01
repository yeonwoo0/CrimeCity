<?php
session_start();
include "../utils/common.php";

$fileidx = isset($_GET['idx']) ? $_GET['idx'] : '';
if ($fileidx == ''){
    echo "<script>alert('잘못된 접근입니다.');history.back(-1);</script>";
    exit;
}
//쿼리 실행부분. 파일 다운로드 기능
$query = "SELECT * FROM board WHERE idx = ?";
$stmt = $db_conn->prepare($query);
$stmt->bind_param("i", $fileidx);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
// $result = $db_conn->query($query);
// $row = $result->fetch_assoc();
$filepath = "../user_upload_files/".$row['filename'];
$filename = $row['filename'];
if(is_file($filepath)){
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Transfer-Encoding: binary");
    readfile($filepath); // 파일을 출력합니다.
    exit;
} else {
    echo "<script>alert('파일이 존재하지 않습니다.');history.back(-1);</script>";
    exit;
}
?>