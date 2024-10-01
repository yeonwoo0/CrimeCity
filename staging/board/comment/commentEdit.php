<?php
    session_start();
    include "../../utils/common.php";
    header("Content-Type: text/html; charset=UTF-8");

    $idx = isset($_GET['idx']) ? $_GET['idx'] : 0;
    $comment_idx = isset($_GET['commentidx']) ? $_GET['commentidx'] : 0;
    // if(preg_match("/^[0-9]*$/", $idx) == 0){
    //     echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
    //     exit;
    // }else if(preg_match("/^[0-9]*$/", $comment_idx) == 0){
    //     echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
    //     exit;
    // }else if($idx == 0 || $comment_idx == 0){
    //     echo "<script>alert('비정상적인 접근입니다.');history.back(-1);</script>";
    //     exit;
    // }


    $query = "SELECT * FROM comments WHERE boardidx = $idx";
    $result = $db_conn->query($query);
    $comments = array();
    
    // 결과값을 반복하여 연관 배열로 저장합니다.
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    for($i=0; $i<count($comments); $i++){
        $comments[$i]['comment_text'] = str_replace("<br>","\r\n", $comments[$i]['comment_text']);
    }
 

    $query = "SELECT * FROM board WHERE idx = $idx";
    $result = $db_conn->query($query);
    $num = ($result && $result->num_rows) ? $result->num_rows : 0;
    if ($num == 0){
        echo "<script>alert('존재하지 않는 게시글입니다.');history.back(-1)</script>";
        exit;
    }
    $row = $result->fetch_assoc();
    $filename = isset($row['filename']) ? $row['filename'] : '';
    if($row['password'] == 'CATCHMEIFYOUCAN'){
        $writer = '관리자';
    }else{
        $writer = $row['writer'];
    }
    $db_conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability WebSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../utils/main.css">
    <link rel="stylesheet" href="../../utils/common.js">
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
                            <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../board.php">Board</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../review.php">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../login/register.php">Register</a>
                        </li>
                        <?php
                        if(!isset($_SESSION['login'])){
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../login/user_login.php">Login</a>
                        </li>
                        <?php
                            }else{

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../login/logout.php">Logout</a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php 
                            if(isset($_SESSION['id'])){
                                if($_SESSION['id'] == 'CATCHMEIFYOUCAN'){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mypage.php">관리자님</a>
                        </li>
                        <?php
                                }else{
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../../mypage.php"><?=$_SESSION['id']?>님</a>
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
                    <div style="width: 15%; border-right:1px black solid; min-height:50px; padding:13px; text-align: center; word-wrap: break-word;">
                        <?=$writer?>
                    </div>
                    <div style="width: 50%; border-right:1px black solid; min-height:50px; padding:13px; word-wrap: break-word;">
                        <?=$row['title']?>
                    </div>
                    <div style="width: 15%; min-height:50px; padding:13px;text-align: center; border-right:1px grey solid; word-wrap: break-word;">
                        <?=substr($row['regdate'],0,10)?>
                    </div>
                    <div style="width: 15%; min-height:50px; padding:13px;text-align: center; font-size:10px; word-wrap: break-word;">
                        <a href="../download.php?idx=<?=$row['idx']?>"><?=$row['filename']?></a>
                    </div>
                </div>
                <div style="overflow: auto; border:1px solid grey; border-radius:5px; padding:20px; margin-top:20px; min-height:400px">
                    <?=$row['content']?>
                </div>
                    <?php
                        for($i=0; $i<count($comments); $i++){
                    ?>
                    <!-- 댓글 목록 나열 폼 -->
                    <div style="margin-top:10px">
                    <?php
                        if($comments[$i]['id'] == 'CATCHMEIFYOUCAN'){
                    ?>
                            <strong>작성자 : 관리자님</strong>
                    <?php
                        }else{
                    ?>
                            <strong>작성자 : <?=$comments[$i]['id']?></strong>
                    <?php
                        }
                    ?>
                        <strong style="float:right">날짜 : <?=date('Y-m-d', strtotime($row["regdate"]))?></strong>    
                    </div>

                    <?php
                        if($comments[$i]['idx'] == $comment_idx){
                    ?>
                        <div style="display: flex; align-items: flex-start; width:100%; overflow:auto">
                            <form action="./commentEditAction.php" style="width:100%; display:flex" method="post">
                                <textarea style="width:100%" name="text" id=""><?=$comments[$i]['comment_text']?></textarea>
                                <input type="hidden" value="<?=$comments[$i]['idx']?>" name="idx">
                                <input type="hidden" value="<?=$comments[$i]['boardidx']?>" name="boardidx">
                                <input type="submit" class="btn btn-sm btn-outline-success" style="margin-left: auto;height:70px; width:10%" value="Edit">
                            </form>
                        </div>
                    <?php
                        }else{
                    ?>
                    <div style="display: flex; align-items: flex-start; width:100%; overflow:auto">
                        <div class="coment-box"><?=$comments[$i]['comment_text']?></div>
                    </div>
                    <?php
                        }
                        ?>
                <?php
                    }
                ?>
            </div>
            <div style="margin-top:30px">
                <button type="button" class="btn btn-outline-danger" style="margin-top: 10px;" id="list_btn">Back</button>
            </div>
        </div>
    </div>
    <script>
        // 이벤트 핸들링을 위한 변수 선언
        const list_btn = document.querySelector('#list_btn');

        // list 버튼을 누르면 board 페이지로 전환
        list_btn.addEventListener('click', ()=>{
            window.location.href = '../view.php?idx=<?=$idx?>';
        });
    </script>
</body>
</html>
