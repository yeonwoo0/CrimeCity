<?php
session_start();
include "./utils/common.php";
header("Content-Type: text/html; charset=UTF-8");

if(!isset($_SESSION['id'])){
    echo "<script>alert('로그인 후 이용 가능합니다.');history.back(-1);</script>";
    exit;
}
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = $db_conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $introduction = isset($row['introduction']) ? $row['introduction'] : '';
} else {
    echo "<script>alert('조회에 실패했습니다.');history.back(-1);</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability WebSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./utils/main.css">
    <link rel="stylesheet" href="./utils/common.js">
</head>
<body>
    <div style="width:80%; margin: auto; margin-top:20px">
        <!-- 부트스트랩 navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center" >
            <div class="container">
                <a class="navbar-brand" href="./index.php">ACS Secure</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./product.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./board/board.php">Board</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./review.php">Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login/register.php">Register</a>
                    </li>
                    <?php
                            if(!isset($_SESSION['login'])){

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./login/user_login.php">Login</a>
                        </li>
                        <?php
                            }else{

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./login/logout.php">Logout</a>
                        </li>
                        <?php
                            }
                        ?>
                    <?php 
                        if(isset($_SESSION['id'])){
                            if($_SESSION['id'] == 'CATCHMEIFYOUCAN'){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./mypage.php">관리자님</a>
                    </li>
                    <?php
                            }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./mypage.php"><?=$_SESSION['id']?>님</a>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <form class="d-flex" role="search" action="./board/board.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="nev_search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="mypage">
        <div style="display:flex">
            <div style="width:70%; margin-left:15px;">
                <form action="./mypageAction.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="basic-addon1">User ID</span>
                        <input name="user_id" value="<?=$_SESSION['id']?>" type="text" class="form-control" placeholder="<?=$_SESSION['id']?>" aria-label="Username" aria-describedby="basic-addon1">
                        <input type="hidden" value="<?=$row['idx']?>" name="idx">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input name="old_pass" type="password" class="form-control" placeholder="현재 패스워드" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">New password</span>
                        <input name="new_pass1" type="password" class="form-control" placeholder="변경할 패스워드" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">New password</span>
                        <input name="new_pass2" type="password" class="form-control" placeholder="변경할 패스워드 확인" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Introduction</span>
                        <textarea class="form-control" aria-label="With textarea" name="introduction"><?=$introduction?></textarea>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Profile</span>
                        <input type="file" class="form-control" id="inputGroupFile01" name="userfile">
                    </div>
                    <div style="margin-top: 20px; text-align: center;">
                        <input type="submit" class="btn btn-outline-success" value="Edit" style="width:100px;"></input>
                        <button id="backBtn" type="button" class="btn btn-outline-danger" style="width:100px;">Back</button>
                    </div>
                </form>
            </div>
            <div style="margin:auto">
                <?php
                    if($row['profile'] != ''){
                ?>
                    <img src="./user_upload_files/profile/<?=$row['profile']?>" alt="" style="width: 150px; height: auto;">
                <?php
                    }else{
                ?>
                    <img src="./user_upload_files/profile/th.jpg" alt="" style="width: 150px; height: auto;">
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        const backBtn = document.querySelector('#backBtn');
        backBtn.addEventListener('click', ()=>{
            history.back(-1);
        })
    </script>
</body>