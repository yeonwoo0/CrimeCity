<?php
    session_start();
    include "./utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    //입력한 값을 가져오는 과정
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $old_pass = isset($_POST['old_pass']) ? $_POST['old_pass'] : '';
    $new_pass1 = isset($_POST['new_pass1']) ? $_POST['new_pass1'] : '';
    $new_pass2 = isset($_POST['new_pass2']) ? $_POST['new_pass2'] : '';
    $introduction = isset($_POST['introduction']) ? $_POST['introduction'] : '';
    $idx = isset($_POST['idx']) ? $_POST['idx'] : 0;

    if($idx == 0){
        echo "<script>alert('unusual request');history.back(-1);</script>";
        exit;
    }
    $query = "SELECT * FROM users WHERE idx = $idx";
    $result = $db_conn->query($query);
    if (!$result) {
        echo "<script>alert('unusual request');</script>";
        exit;
    }
    if ($result->num_rows == 0) {
        echo "<script>alert('존재하지 않는 계정입니다.');</script>";
        exit;
    }
    $row = $result->fetch_assoc();
    

    //입력값 검증로직
    if($_SESSION['id'] != 'CATCHMEIFYOUCAN'){
        if(strlen($old_pass)>14){
            echo "<script>alert('Please set your password to 14 characters or less.');history.back(-1);</script>";
            exit;
        }
    }
    if($new_pass1 != $new_pass2){
        echo "<script>alert('The passwords to be changed do not match');history.back(-1);</script>";
        exit;
    }else if(strlen($new_pass1)>14 || strlen($new_pass2)>14){
        echo "<script>alert('Please set your password to 14 characters or less.');history.back(-1);</script>";
        exit;
    }


    if(!$result){
        echo "<script>alert('Invalid id');history.back(-1);</script>";
        exit;
    }else if($row['password'] != $old_pass){
        echo "<script>alert('Password does not match');history.back(-1);</script>";
        exit;
    }

    // 파일 업로드 처리
    if(!empty($_FILES['userfile']['name'])) {
        $filename = $_FILES['userfile']['name']; 
        $upload_path = "./user_upload_files/profile/".$filename; 
        $file_info = pathinfo($upload_path); 
        $ext = strtolower($file_info["extension"]);
        $ext_arr = array('jpg', 'jpeg', 'png', 'gif'); 
        // 업로드된 파일의 확장자가 허용 목록에 있는지 확인
        if(!in_array($ext, $ext_arr)){
            echo "<script>alert('Extention Not allowed');history.back(-1);</script>";
            exit;
        } else if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path)){
            echo "<script>alert('Upload Failed');history.back(-1)</script>";
            exit;
        }
        $upload_msg = 'Upload Successful : '.$upload_path;
        echo "<script>alert({$upload_msg})</script>";
    }else{
        $filename = isset($row['profile']) ? $row['profile'] : '';

    }

    $hash = hash("sha256", $user_id);
    //패스워드 신규 입력값이 없다면 기존 패스워드를 사용
    if($new_pass1 == ''){
        $query = "UPDATE users SET id='$user_id', password='$old_pass', introduction='$introduction', profile='$filename', hash='$hash' WHERE idx = $idx";
    }else {
        $query = "UPDATE users SET id='$user_id', password='$new_pass1', introduction='$introduction', profile='$filename', hash='$hash' WHERE idx = $idx";
    }

    $result = $db_conn->query($query);
    if($result) {
        echo "<script>alert('Successfully updated your profile');</script>";
        $_SESSION['id'] = $user_id;
        $_SESSION['login'] = hash("sha256",$user_id); // 세션 변수 설정
     } else {
        echo "<script>alert('Failed to update profile');</script>";
        exit;
     }
     echo "<script>self.location.href='./index.php';</script>";
?>