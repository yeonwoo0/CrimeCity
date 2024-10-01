<?php
session_start();
include "../utils/common.php";
include "./content.php";
$lecture_title = array(
    "web" => array('SQL과 DBMS', '오늘날의 SQLi', '프로세스와 상세로직', '파일 업로드 기능의 이해', '파일 다운로드 기능과 연계가능 한 업로드 공격'),
    "mobile" => array('최근 보안 시장에서의 모바일 분야', '프리다란 무엇인가?', '후킹, 그리고 해킹'),
    "system" => array('시스템 해킹이란?', '레드팀에 대해', '시스템 해킹 방법론', '리눅스 권한 상승', '윈도우 권한상승')
);

$lecture_content = array(
    "web" => array($web1, $web2, $web3,$web4, $web5),
    "mobile" => array($mobile1, $mobile2, $mobile3),
    "system" => array($system1, $system2, $system3,$system4, $system5)
);

$lecture_gubun = array(
    "web" => array('sqlanddbms', 'todaySQLi', 'processandlogic', 'fileupload', 'filedoanandfileupload'),
    "mobile" => array('recentlymobile', 'whatsfrida', 'hookingandhacking'),
    "system" => array('whatssystem','redteam','systemhacking','linuxauthority','windowsauthority')
);

$lecture = isset($_COOKIE['lecture']) ? $_COOKIE['lecture'] : '';
$gubun = isset($_COOKIE['gubun']) ? $_COOKIE['gubun'] : '';

$show_title = ""; // 초기화

if($lecture == 'web'){
    $web = $lecture_gubun['web'];
    for($i=0; $i<count($web); $i++){
        if($web[$i] == $gubun){
            $show_title = $lecture_title['web'][$i];
            $show_content = $lecture_content['web'][$i];
        }
    }
}else if($lecture == 'mobile'){
    $mobile = $lecture_gubun['mobile'];
    for($i=0; $i<count($mobile); $i++){
        if($mobile[$i] == $gubun){
            $show_title = $lecture_title['mobile'][$i];
            $show_content = $lecture_content['mobile'][$i];
        }
    }
}else if($lecture == 'system'){
    $system = $lecture_gubun['system'];
    for($i=0; $i<count($system); $i++){
        if($system[$i] == $gubun){
            $show_title = $lecture_title['system'][$i];
            $show_content = $lecture_content['system'][$i];
        }
    }
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
        <div style="width:80%; margin:auto">
            <div>
                <div style="width:100%; border:1px solid grey; border-radius: 5px; min-height: 50px; display:flex; margin-top:20px;">
                    <div style="width: 15%; border-right:1px black solid; min-height:50px; padding:13px; text-align: center">
                        관리자
                    </div>
                    <div style="width: 50%; border-right:1px black solid; min-height:50px; padding:13px">
                        <?=$show_title?>
                    </div>
                    <div style="width: 15%; min-height:50px; padding:13px;text-align: center; border-right:1px grey solid">
                        2024-05-07
                    </div>
                    <div style="width: 15%; min-height:50px; padding:13px;text-align: center; font-size:10px">
                        <a></a>
                    </div>
                </div>
                <div style="overflow: auto; border:1px solid grey; border-radius:5px; padding:20px; margin-top:20px; min-height:400px">
                    <?=$show_content?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-warning" style="margin-top: 10px;" id="list_btn">List</button>
        </div>
    </div>
    <script>
        // 이벤트 핸들링을 위한 변수 선언
        const list_btn = document.querySelector('#list_btn');

        // list 버튼을 누르면 board 페이지로 전환
        list_btn.addEventListener('click', ()=>{
            history.back(-1);
        });
    </script>
</body>
</html>
