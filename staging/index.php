<?php
    session_start();
    include "./utils/common.php";
    $query = "SELECT title, writer,idx,password FROM board limit 0, 5";
    $result = $db_conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACS Security</title>
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
        <!-- 부트스트랩 navbar -->
        <!-- 캐러셀 박스 -->
            <div style="overflow: hidden; width: 100%; margin-top:10px">
                <div class="slide-container">
                    <div class="slide-box">
                        <img src="./image/ban1.png" alt="">
                    </div>         
                    <div class="slide-box">
                        <img src="./image/ban2.png" alt="">
                    </div>   
                    <div class="slide-box">
                        <img src="./image/ban3.png" alt="">
                    </div>
                </div>
            </div>
        <!-- 캐러셀 박스 -->
        <div class="main-box">
            <h2 style="margin-top: 30px"><strong>ArmorVigil Cybersecurity Solutions</strong></h2>
            <h4 style="margin-top: 20px;">당사는 정보보안 분야에서 선두 주자로서 모의해킹 전문 서비스를 제공합니다. 전 세계적으로 신뢰받는 보안 전문가들이 모여 고객사의 디지털 환경을 신속하게 분석하고, 최첨단 기술과 첨단 도구를 활용하여 취약점을 식별하고 해결책을 제시합니다. 고객사의 보안 수준을 높이고 사이버 공격으로부터 안전을 보장하는 데 전력을 다하고 있습니다. 함께하여 고객사의 디지털 자산을 보호하고 신뢰를 구축해 나가겠습니다.</h4>
        </div>
        <div style="width:90%; margin: auto">
            <div class="sub-box">
                <div>
                    <h4><strong>취약점 체크리스트 점검</strong></h4>
                    <h6>취약점 체크리스트 점검은 다양한 보안 취약점을 포함하는 체계적인 점검 항목들의 목록을 기반으로 합니다. 이를 통해 고객의 시스템에 존재하는 보안 취약점을 신속하게 파악하고, 이에 대한 적절한 대응책을 마련할 수 있습니다.</6>
                </div>
                <div>
                    <h4><strong>웹 모의해킹</strong></h4>
                    <h6>웹 애플리케이션과 웹사이트에 존재하는 보안 취약점을 식별하고, 해킹 시뮬레이션을 통해 고객의 시스템을 보호하는 데 도움을 줍니다. SQL Injection, Cross-Site Scripting (XSS), 인증 및 권한 부여 문제 등과 같은 주요 보안 취약점을 신속하게 파악하고 대응할 수 있습니다.</h6>
                </div>
                <div>
                    <h4><strong>시나리오 모의침투</strong></h4>
                    <h6>침투 테스트는 외부 공격자가 내부 네트워크로 침입하거나 내부 공격자가 외부 시스템에 접근하는 시나리오를 시뮬레이션합니다. 우리의 전문 보안 전문가들은 다양한 공격 기법과 도구를 사용하여 고객의 시스템에 대한 보안 취약점을 찾고, 이를 통해 적절한 대응 및 보호를 제공합니다.</h6>
                </div>
                <div>
                    <h4><strong>모바일 모의해킹</strong></h4>
                    <h6>모바일 애플리케이션과 모바일 기기에 존재하는 보안 취약점을 식별하고, 보안 위협으로부터 고객의 비즈니스를 보호하는 데 도움을 줍니다. 다양한 모바일 플랫폼(Android 및 iOS)과 앱의 보안을 체크하며 이를 통해 인증 및 권한 부여 문제, 데이터 유출 가능성, 불안정한 코딩 등과 같은 주요 보안 취약점을 신속하게 파악하고 대응할 수 있습니다.</h6>
                </div>
            </div>
            <div style=" display:flex">
                <table class="table" style="width: 50%;">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50%">Title</th>
                            <th scope="col" style="width: 20%">Writer</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php 
                            // 결과 반복문을 사용하여 모든 레코드 출력
                            while ($row = $result->fetch_assoc()) {
                                if($row['password'] == 'NoBruteForce'){
                        ?>
                                <tr>
                                    <th><a href="./board/view.php?idx=<?=$row['idx']?>" style="color:black;text-decoration: none;"><?=$row['title']?></a></th>
                                    <th>관리자</th>
                                </tr>
                        <?php        
                            }else{
                        ?>
                        <tr>   
                            <td scope="col" style="width: 50%;"><a style="color:black;text-decoration: none;" href="./board/view.php?idx=<?=$row['idx']?>"><?=$row['title']?></a></td>
                            <td scope="col" style="width: 20%"><?=$row['writer']?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="review-box">
                    <h5><strong>고객님들의 리뷰를 직접 확인해보세요!!</strong></h5>
                    <p>우리의 고유한 요구 사항을 고려하여 맞춤형 솔루션을 제공해 주었습니다 👍👍 <strong>- 한예광님</strong></p>
                    <p>네트워크와 시스템에서 발생할 수 있는 잠재적인 위협을 식별하고 최신 보안 기술을 적용하는 데 우리에게 큰 자신감을 주었습니다.💕 감사합니다! <strong>- 이경완님</strong></p>
                    <p>컨설팅을 통해 보안 인프라를 효율적으로 관리하고 보안 정책을 준수하는 데 필요한 지침을 받아 비즈니스를 보호할 수 있게 되었습니다.!!! <strong>- 김희현님</strong></p>
                    <p>⭐⭐⭐⭐⭐ 전문가분들이 발견된 문제를 신속하게 분석하고 해결책을 제시하여 우리의 시스템을 보다 안전하게 유지할 수 있게 도와주었습니다.💯 <strong>- 신지희님</strong></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btn_history = document.querySelector('#history');
        const history_modal = document.querySelector('#history-show');
        document.addEventListener("DOMContentLoaded", function() {
            const slide_container = document.querySelector('.slide-container');
            let i = 0;
            function repeat() {
                setTimeout(() => {
                    slide_container.style.transform = `translateX(${-i * 80}vw)`;
                    i++;
                    if (i > 2) i = 0;
                    repeat(); 
                }, 2500);
            }
            repeat(); 
        });
    </script>
</body>
</html>
