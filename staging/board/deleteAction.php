<?php
session_start();
include "../utils/common.php";

if(!isset($_SESSION['login'])){
    echo "<script>alert('로그인 후 이용 가능합니다.');window.location.href='../login/user_login.php';</script>";
    exit;
}
// 유저가 입력한 패스워드를 변수에 할당
$inputPass = isset($_GET['inputPass']) ? $_GET['inputPass'] : '';
$idx = isset($_GET['idx']) ? $_GET['idx'] : '';
// Validate idx parameter
if (!is_numeric($idx)) {
    echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1);</script>";
    exit;
}
// SQL 인젝션 위험이 있는 문자는 필터링. 경고문자는 겁주기용
$sqli_words = array("'", '"', "/", "\\", "(", ")", "*");
if (in_array($inputPass, $sqli_words)) {
    echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1);</script>";
    exit;
}
//쿼리 실행부분
$query = "SELECT * FROM board WHERE idx = ?";
$stmt = $db_conn->prepare($query);
$stmt->bind_param("i", $idx);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// 게시글이 존재하는 경우에만 삭제 시도
if ($result->num_rows > 0) {
    // 입력된 비밀번호가 일치하는 경우에만 삭제
    if ($inputPass == $row['password']) {
        $query = "DELETE FROM board WHERE idx = ?";
        $stmt = $db_conn->prepare($query);
        $stmt->bind_param("i", $idx);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('게시글이 삭제되었습니다.');window.location.href='./board.php';</script>";
        exit;
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.');history.back(-1);</script>";
        exit;
    }
} else {
    echo "<script>alert('해당하는 게시글이 존재하지 않습니다.');window.location.href='./board.php';</script>";
    exit;
}
?>
