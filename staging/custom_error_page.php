<?php
    session_start();
    include "../utils/common.php";
    $query = "SELECT title, writer,idx,password FROM board limit 0, 5";
    $result = $db_conn->query($query);
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
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../product.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../board/board.php">Board</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../review.php">Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/register.php">Register</a>
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
                <form class="d-flex" role="search" action="../board/board.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="nev_search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    
    <div style="display: flex; justify-content: center; margin-top:50px;">
    <strong style="font-size: 30px;">403 Forbidden...</strong>
        <img src="../image/403.png" alt="">
    </div>
</body>