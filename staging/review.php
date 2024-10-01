<?php
    session_start();
    include "./utils/common.php";
    $query = "SELECT idx, content, id FROM review";
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
            <div class="main-container">
                <h3 style="text-align: center;padding-top:20px">Please write your review!</h3>
                <hr class="underline" style="width:50%; margin:auto;">
                <form action="reviewAction.php" method="post">
                    <textarea name="review" name="review" cols="30" rows="10" class="textarea-box"></textarea>
                    <br>
                    <button type="submit" class="btn btn-outline-success" style="margin-bottom: 95px; width: 100px; height: 50px">Write</button>
                    <button id="btn_back" type="button" class="btn btn-outline-danger" style="margin-bottom: 95px; width: 100px; height: 50px">Back</button>
                </form>
                <!-- 적당한 리뷰수를 위한 하드코딩 -->
                <div style="width:60%; margin:auto">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse100" aria-expanded="false" aria-controls="collapse100">
                                Kim HyungWoo님의 소중한 리뷰
                            </button>
                            </h2>
                            <div id="collapse100" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p style="text-align: left;">보안회사의 컨설팅 서비스는 우리 기업의 보안 전략을 강화하는 데 큰 도움이 되었습니다👍👍 전문가들은 신속하고 친절한 상담으로 우리의 요구에 맞는 해결책을 제시해 주었습니다. 그 결과로 우리는 보다 안전한 환경에서 업무를 진행할 수 있게 되었습니다😊</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse101" aria-expanded="false" aria-controls="collapse101">
                                Park YeonWoo님의 소중한 리뷰
                            </button>
                            </h2>
                            <div id="collapse101" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p style="text-align: left;">모의해킹 서비스는 우리의 시스템이 실제 공격에 얼마나 견고한지를 확인하는 데 탁월한 도구였습니다.ㅎㅎ 😊전문적인 해커들이 다양한 공격 시나리오를 시도하며 발견된 취약점을 보완할 수 있었습니다. 이를 통해 우리는 시스템의 보안 수준을 향상시킬 수 있었습니다. 감사합니다!!🙌🙌</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse102" aria-expanded="false" aria-controls="collapse102">
                                Kim Heehyun님의 소중한 리뷰
                            </button>
                            </h2>
                            <div id="collapse102" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p style="text-align: left;">모의침투 테스트는 우리의 네트워크 및 시스템에 대한 실제 공격과 유사한 시나리오를 통해 보안 취약점을 발견하는 데 도움이 되었습니다⭐⭐⭐⭐⭐ 전문가분들이 발견된 문제를 신속하게 분석하고 해결책을 제시하여 우리의 시스템을 보다 안전하게 유지할 수 있게 도와주었습니다.💯</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse103" aria-expanded="false" aria-controls="collapse103">
                                Shin JiHee님의 소중한 리뷰
                            </button>
                            </h2>
                            <div id="collapse103" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p style="text-align: left;">안드로이드 해킹 서비스는 우리의 모바일 애플리케이션 보안을 강화하는 데 큰 역할을 하였습니당😍전문적인 해커분들께서 다양한 해킹 기술을 사용하여 우리 애플리케이션의 취약점을 찾아내고 보완할 수 있었습니다. 이를 통해 사용자 데이터의 안전을 보장하고 우리의 평판을 유지할 수 있었습니다. 고맙습니다 ACS💕</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse104" aria-expanded="false" aria-controls="collapse104">
                                Han YeGwang님의 소중한 리뷰
                            </button>
                            </h2>
                            <div id="collapse104" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p style="text-align: left;">보안회사의 컨설팅 서비스는 전문적이고 친절한 상담으로 우리 기업의 보안 취약점을 신속하게 파악할 수 있었습니다. 해결책을 제시해 주셔서 매우 만족합니다. 굿잡~~💯💯💯</p>
                            </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$row['idx']?>" aria-expanded="false" aria-controls="collapse<?=$row['idx']?>">
                                    <?=$row['id']?>님의 소중한 리뷰
                                </button>
                                </h2>
                                <div id="collapse<?=$row['idx']?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p style="text-align: left;"><?=$row['content']?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
</body>
</html>