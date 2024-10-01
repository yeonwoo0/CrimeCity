<?php
session_start();
include "../utils/common.php";

if(isset($_GET['lecture'])) {
    $lecture_title = $_GET['lecture'];
    if($lecture_title == 'web'){
        $title = array('SQL과 DBMS', '오늘날의 SQLi', '프로세스와 상세로직', '파일 업로드 기능의 이해', '파일 다운로드 기능과 연계가능 한 업로드 공격');
        $cookie = array('sqlanddbms', 'todaySQLi', 'processandlogic', 'fileupload', 'filedoanandfileupload');
    }else if($lecture_title == 'mobile'){
        $title = array('최근 보안 시장에서의 모바일 분야', '프리다란 무엇인가?', '후킹, 그리고 해킹');
        $cookie = array('recentlymobile', 'whatsfrida', 'hookingandhacking');
    }else if($lecture_title == 'system'){
        $title = array('시스템 해킹이란?', '레드팀에 대해', '시스템 해킹 방법론', '리눅스 권한 상승', '윈도우 권한상승');
        $cookie = array('whatssystem','redteam','systemhacking','linuxauthority','windowsauthority');
    }
} else {
    echo "<script>alert('잘못된 접근입니다.');history.back(-1)</script>";
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
                            <a class="nav-link" href="../login/user_login.php">Login</a>
                        </li>
                        <?php
                            }else{

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/logout.php">Logout</a>
                        </li>
                        <?php
                            }
                        ?>
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
        <div style="width: 80%; margin: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%; text-align:center"><a href="./board.php?sort_column=index&sort=asc" style="text-decoration: none; color: black">Index ▼</a></th>
                        <th scope="col" style="width: 50%"><a href="./board.php?sort_column=title&sort=asc" style="text-decoration: none; color: black">Title ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./board.php?sort_column=writer&sort=asc" style="text-decoration: none; color: black">Writer ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./board.php?sort_column=regdate&sort=asc" style="text-decoration: none; color: black">Date ▼</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <th style="text-align: center;">[공지]</th>
                        <th><a style="color: black; text-decoration: none">웹해킹 강의 2개는 무료 제공되며 나머지는 유료 결제 바랍니다.</a></th>
                        <th>관리자</th>
                        <th>2024-05-07</th>
                    </tr>
                    <?php
                        for($i=0; $i<count($title); $i++){
                            if($i<2){
                    ?>
                        <tr>
                            <td style="text-align: center">[무료강의]</td>
                            <td><a href="./lectureAction.php?gubun=<?=$cookie[$i]?>&lecture=<?=$lecture_title?>" style="color: black; text-decoration: none"><?=$title[$i]?></a></td>
                            <td>관리자</td>
                            <td>2024-05-07</td>
                        </tr>
                    <?php
                            }else{
                    ?>
                                <tr>
                                <td style="text-align: center">[유료강의]</td>
                                <td><a href="./authority.php" style="color: black; text-decoration: none"><?=$title[$i]?></a></td>
                                <td>관리자</td>
                                <td>2024-05-07</td>
                            </tr>
                    <?php
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>
</body>
</html>
