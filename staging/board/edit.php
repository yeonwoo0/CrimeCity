<?php
    session_start();
    include "../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");
    if(!isset($_SESSION['login'])){
        echo "<script>alert('로그인 후 이용 가능합니다.');window.location.href='../login/user_login.php';</script>";
        exit;
    }
    //겁주기용 문구
    $password = isset($_GET['inputPass']) ? $_GET['inputPass'] : '';
    $idx = isset($_GET['idx']) ? $_GET['idx'] : '';

    if($idx =='' || $password == ''){
        echo "<script>alert('빈칸이 존재합니다..');history.back(-1)</script>";
        exit;
    }else if(preg_match("/^[0-9]*$/", $idx) == 0){
        echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1)</script>";
        exit;
    }else if(strlen($password) > 15){
        echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1)</script>";
        exit;
    }
    // Prepare 쿼리 작성
    $query = "SELECT * FROM board WHERE idx = ?";
    $stmt = $db_conn->prepare($query);
    $stmt->bind_param("i", $idx);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;
    $row = $result->fetch_assoc();
    if($row['password'] != $password){
        echo "<script>alert('패스워드가 일치하지 않습니다.');history.back(-1)</script>";
        exit;
    }
    if ($num = 0){
        echo "<script>alert('해당하는 게시글이 존재하지 않습니다.');window.location.href='./board.php';</script>";
        exit;
    }
    $row['content'] = str_replace("<br>", "\r\n", $row['content']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability WebSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../utils/main.css">
    <link rel="stylesheet" href="../utils/common.js">
</head>
<body>
    <div style="width:80%; margin: auto; margin-top:20px">
        <!-- 부트스트랩 navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center" >
            <div class="container">
                <a class="navbar-brand" href="../index.php">ACS Secure</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./board.php">Board</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../review.php">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/register.php.">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/user_login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/logout.php">Logout</a>
                        </li>
                        <?php 
                            if(isset($_SESSION['id'])){
                                if($_SESSION['id'] == 'CATCHMEIFYOUCAN'){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../mypage.php">관리자님</a>
                        </li>
                        <?php
                                }else{
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../mypage.php"><?=$_SESSION['id']?>님</a>
                        </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                    <form class="d-flex" role="search" action="./board.php">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="nev_search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="parent">
            <div>
            <form action="./editAction.php" method="post" enctype="multipart/form-data">
                    <input type="text" class="input-box" autocomplete="off" placeholder="제목을 입력하세요." name="title" id="title" value="<?=$row['title']?>">
                    <input type="hidden" name="userpass" value="<?=$password?>">
                    <input type="hidden" name="idx" value="<?=$row['idx']?>">
                    <textarea name="content" id="" cols="30" rows="10" class="text-box" autocomplete="off" placeholder="본문 내용을 입력하세요." id="content"><?=$row['content']?></textarea>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="hidden" name="filename" value="<?=$row['filename']?>">
                        <input type="file" class="form-control" id="inputGroupFile01" name="userfile">
                    </div>
                    <input type="submit" class="btn btn-outline-success" id="write" value="Edit">
                    <button type="button" class="btn btn-outline-danger" id="back">List</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const back = document.querySelector('#back');
            back.addEventListener('click', () => {
                window.location.href = "./board.php";
            });
        });
        const btn_submit = document.querySelector('#write');
        btn_submit.addEventListener("click", (e)=>{
            const title = document.querySelector('#title');
            const content = document.querySelector('.text-box');
            if(title.value == '') {
                alert('제목을 입력하세요.');
                title.focus()
                e.preventDefault();
                return
            }
            else if(content.value == ''){
                alert('본문을 입력하세요.');
                content.focus();
                e.preventDefault();
                return
            }
        })
    </script>
</body>
</html>