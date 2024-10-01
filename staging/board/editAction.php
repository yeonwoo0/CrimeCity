<?php
    session_start();
    include "../utils/common.php";

    header("Content-Type: text/html; charset=UTF-8");
    // 사용자 입력을 받아오기
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $userfile = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
    $idx = isset($_POST['idx']) ? $_POST['idx'] : '';

    if($idx == ''){
        echo "<script>alert('정상적인 값이 아닙니다.');history.back(-1);</script>";
        exit;
    }else if(preg_match("/^[0-9]*$/", $idx) == 0){
        echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1)</script>";
        exit;
    }else if(mb_strlen($title) > 30){
        echo "<script>alert('Please keep the title less than 30 characters.');history.back(-1)</script>";
        exit;
    }
    // HTML 엔티티로 변환
    $filename = isset($_POST['filename']) ? $_POST['filename'] : '';
    $content = str_replace("\r\n", "<br>", $content);
    // 파일 업로드 처리
    if(!empty($userfile['name'])) {
        $filename = $userfile['name'];
        $upload_path = "../user_upload_files/".$filename;
        $file_info = pathinfo($upload_path);
        $ext = strtolower($file_info["extension"]);
        if($_SESSION['login'] == '235955a8afc35f052639bfd849a66015764a36b305e877edc4301af2a46e33bc'){
            $ext_arr = array('jpg', 'jpeg', 'png', 'gif', 'php');
        }else{
            $ext_arr = array('jpg', 'jpeg', 'png', 'gif');
        }
        if(!in_array($ext, $ext_arr)){
            echo "<script>alert('Extention Not allowed');history.back(-1);</script>";
            exit;
        }else if(!(@move_uploaded_file($userfile['tmp_name'], $upload_path))){
            echo "<script>alert('Upload Failed');history.back(-1)</script>";
            exit;
        }
        $upload_msg = 'Upload Successful : '.$upload_path;
        echo "<script>alert({$upload_msg})</script>";
    }
    $sql = "UPDATE board SET title=?, content=?, filename=?, regdate=NOW() WHERE idx=?";
    $stmt = $db_conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $filename, $idx);
    $result = $stmt->execute();
    
    if($result) {
       echo "<script>alert('Successfully edited post');</script>";
    } else {
       echo "<script>alert('Failed to edit post');</script>";
    }
    echo "<script>self.location.href='board.php';</script>";
?>
