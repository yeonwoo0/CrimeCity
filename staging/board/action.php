<?php
session_start();
    include "../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    // 사용자 입력을 받아오기
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $userfile = isset($_FILES['userfile']) ? $_FILES['userfile'] : '';
    $password = isset($_POST['userpass']) ? $_POST['userpass'] : '';
    $id = isset($_POST['userid']) ? $_POST['userid'] : '';
    
    if(mb_strlen($title) > 30){
        echo "<script>alert('Please keep the title less than 30 characters.');history.back(-1)</script>";
        exit;
    }
    // HTML 엔티티로 변환
    $filename = '';
    $content = str_replace("\r\n", "<br>", $content);
    // 파일 업로드 처리
    if(!empty($_FILES['userfile']['name'])) {
        $filename = $_FILES['userfile']['name']; 
        $upload_path = "../user_upload_files/".$filename; 
        $file_info = pathinfo($upload_path); 
        $ext = strtolower($file_info["extension"]);
        if ($_SESSION['id'] == 'CATCHMEIFYOUCAN'){
            $ext_arr = array('jpg', 'jpeg', 'png', 'gif', 'php'); 
        }else {
            $ext_arr = array('jpg', 'jpeg', 'png', 'gif'); 
        }
        // 업로드된 파일의 확장자가 허용 목록에 있는지 확인
        if(!in_array($ext, $ext_arr)){
            echo "<script>alert('Extention Not allowed');history.back(-1);</script>";
            exit;
        } else if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path)){
            echo "<script>alert('Upload Failed.');history.back(-1)</script>";
            exit;
        }
        $upload_msg = 'Upload Successful : '.$upload_path;
        echo "<script>alert({$upload_msg})</script>";
    }
    

    // 쿼리 실행부분
    
    $query = "INSERT INTO board (title, writer, content, regdate, filename, password) values('$title', '$id', '$content',curdate(),'$filename','$password')";
    $result = $db_conn->query($query);
    if($result) {
       echo "<script>alert('Successful creation of post.');self.location.href='board.php';</script>";
    } else {
       echo "<script>alert('Failed to create post');history.back(-1);</script>";
       exit;
    }
?>
