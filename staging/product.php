<?php
    session_start();
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
    <div class="offcanvas offcanvas-start show" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasLabel"><strong>What's different?</strong></h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>
                <strong>1. 우리 회사는 정보보안의 근본적인 해결책과 뛰어난 가이드라인을 제공합니다. </strong>
                <p>우리의 접근법은 단순히 취약점을 파악하고 막는 것을 넘어서, 정보보안을 기업의 핵심 가치로 통합하여 진정한 보안 문화를 구축하는 데 초점을 맞춥니다.</p>
                <strong>2. 우리는 100%의 성공률을 자랑합니다. </strong>
                <p>이는 우리가 제공하는 해결책과 가이드라인이 실제로 보안 문제를 해결하고 고객의 비즈니스를 보호하는 데 효과적임을 보여줍니다.</p>
                <strong>3. 고객사의 개별적인 요구에 맞춘 맞춤형 솔루션을 제공합니다. </strong>
                <p>우리의 전문가들은 고객사의 고유한 환경과 요구에 맞게 최적의 보안 전략을 개발합니다.</p>
                <strong>4. 고객사의 성공을 위해 최신 기술과 트렌드를 적극적으로 적용합니다.</strong>
                <p>우리는 지속적인 연구와 개발을 통해 고객사가 미래의 보안 도전에 대비할 수 있도록 지원합니다.</p>
                <strong>5. 우리의 전문가들은 업계에서 최고 수준의 경험과 노하우를 보유하고 있습니다.</strong>
                <p>우리 팀은 다양한 산업 분야에서 다년간의 경력을 보유하고 있어, 고객사의 다양한 요구에 대응할 수 있습니다.</p>
                <strong>6. 우리는 정보보안을 통해 고객사의 비즈니스를 안전하게 보호하고 성장을 이끌어 나갑니다.</strong>
                <p>우리는 고객사의 파트너로서 항상 최선을 다하며, 함께하는 여정에서 안정성과 성공을 보장합니다.</p>
            </p>
        </div>
    </div>
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

            <div style="margin-top: 20px;">
                <div style="display: flex; align-items: flex-start;">
                    <img src="./image/mobile.jpg" alt="" style="width: 30%; margin-bottom: 20px; min-width: 30%;">
                    <div style="flex: none; padding-left: 20px; width: 60%;">
                        <h3><a href="./lecture/lecture.php?lecture=mobile">모바일 모의해킹</a></h3>
                        <h6 style="word-wrap: break-word;">
저희의 모바일 모의해킹 서비스는 고객사의 모바일 애플리케이션 보안을 강화하기 위한 체계적인 접근 방식을 제공합니다. 전문 보안 전문가들이 실제 해커의 공격 기술과 도구를 활용하여 애플리케이션의 보안 취약점을 철저하게 분석하고 평가합니다. 이를 통해 고객사는 사용자 데이터와 기밀 정보를 보호하고, 잠재적인 보안 위협에 대응할 수 있는 안전한 환경을 구축할 수 있습니다. 저희의 서비스는 모바일 보안을 강화하고 사용자 신뢰를 유지하는 데 기여합니다.</h6>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start;">
                    <img src="./image/coding.webp" alt="" style="width: 30%; margin-bottom: 20px; min-width: 30%;">
                    <div style="flex: none; padding-left: 20px; width: 60%;">
                        <h3>취약점 체크리스트 점검</h3>
                        <h6 style="word-wrap: break-word;">
저희 취약점 체크리스트 점검 서비스는 고객사의 시스템과 애플리케이션에 대한 철저한 보안 검토를 실시하여 잠재적인 취약점을 식별하고 해결책을 제시합니다. 최신 보안 기술과 전문가의 지식을 활용하여 고객사의 데이터 보호를 강화하고, 보안 위협으로부터 안전을 보장합니다. 저희의 서비스를 통해 고객사는 보다 안전하고 신뢰할 수 있는 IT 인프라를 구축할 수 있으며, 급격히 진화하는 사이버 보안 환경에서 안정성을 유지할 수 있습니다.</h6>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start;">
                    <img src="./image/cmd.png" alt="" style="width: 30%; margin-bottom: 20px; min-width: 30%;">
                    <div style="flex: none; padding-left: 20px; width: 60%;">
                        <h3><a href="./lecture/lecture.php?lecture=system">모의 침투</a></h3>
                        <h6 style="word-wrap: break-word;">저희 모의침투 서비스는 고객사의 시스템 및 네트워크 보안을 철저히 점검하여 잠재적인 위협으로부터 사전에 예방합니다. 전문적인 해킹 기술과 다양한 시나리오를 활용하여 실제 공격과 유사한 상황을 모의하여 보안 취약점을 도출하고 제거하는 데 도움을 드립니다. 최신 보안 기술과 신속한 대응 능력을 바탕으로 고객사의 시스템을 강화하고, 비즈니스의 안전성을 높이는 데 기여합니다. 모의침투 테스트를 통해 고객사는 실제 공격에 대비하고, 보다 안전하고 안정적인 IT 환경을 구축할 수 있습니다.</h6>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start;">
                    <img src="./image/sql.png" alt="" style="width: 30%; margin-bottom: 20px; min-width: 30%;">
                    <div style="flex: none; padding-left: 20px; width: 60%;">
                        <h3><a href="./lecture/lecture.php?lecture=web">웹 모의해킹</a></h3>
                        <h6 style="word-wrap: break-word;">저희 웹 모의해킹 서비스는 고객사의 웹 애플리케이션 보안을 강화하기 위해 최신 해킹 기술과 전문가의 능력을 활용합니다. 다양한 공격 시나리오를 시뮬레이션하여 잠재적인 취약점을 식별하고, 효과적인 대응 방안을 제시합니다. 웹 환경에서 발생할 수 있는 다양한 보안 위협으로부터 고객사의 시스템을 보호하고, 온라인 비즈니스의 안전성을 확보하는 데 도움을 드립니다. 저희의 서비스를 통해 고객사는 신뢰할 수 있는 보안 솔루션을 확보하고, 고객들의 개인 정보를 안전하게 보호할 수 있습니다.</h6>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
