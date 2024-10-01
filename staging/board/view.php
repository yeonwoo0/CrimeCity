<?php
    session_start();
    include "../utils/common.php";
    
    $idx = isset($_GET['idx']) ? $_GET['idx'] : '';
    // if(preg_match("/^[0-9]*$/", $idx) == 0){
    //     echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1);</script>";
    //     exit;
    // }
    $query = "SELECT * FROM comments WHERE boardidx = ?";
    $stmt = $db_conn->prepare($query);
    $stmt->bind_param("i", $idx);
    $stmt->execute();
    $result = $stmt->get_result();
    $comments = array();
    // 결과값을 반복하여 연관 배열로 저장합니다.
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
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
    if($row['password'] == 'NoBruteForce'){
        $writer = '관리자';
    }else{
        $writer = $row['writer'];
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
    <!-- 삭제 수정 누르면 나오는 모달창 평소엔 안 보임 -->
    <div class="black-bg" style=" justify-content: center; align-items: center; height: 100vh;" id="modal">
        <div class="white-bg" style="text-align: center;">
            <h4>패스워드를 입력하세요.</h4>
            <input type="password" style="margin: auto;" class="form-control me-2" id="inputPass">
            <div style="display: flex; justify-content: center; margin-top: 5%;">
                <button type="button" class="btn btn-outline-success" id="modal-text">확인</button>
                <button type="button" class="btn btn-outline-danger" style="margin-left: 10px;" id="modal-cancel">취소</button>
            </div>
        </div>
    </div>
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
                        <a href="./download.php?idx=<?=$row['idx']?>"><?=$row['filename']?></a>
                    </div>
                </div>
                <div style="overflow: auto; border:1px solid grey; border-radius:5px; padding:20px; margin-top:20px; min-height:400px">
                    <?=$row['content']?>
                </div>


                <div style="margin-bottom: 70px;">
                    <form action="./comment/commentAction.php" style="margin-top: 20px; display: flex; align-items: flex-start;" method="post">
                        <textarea name="comment" id="" class="coment-box" style="flex: 1;"></textarea>
                        <input type="submit" class="btn btn-outline-success" id="write" value="Write" style="margin-left: auto;height:70px">
                        <input type="hidden" name="idx" value="<?=$row['idx']?>">
                    </form>
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
                        <strong style="float:right">날짜 : <?=date('Y-m-d', strtotime($comments[$i]["reg"]))?></strong>    
                    </div>
                    <div style="display: flex; align-items: flex-start; width:105%; overflow:auto">
                        <div class="coment-box"><?=$comments[$i]['comment_text']?></div>
                        <div>
                            <button onclick="location.href='./comment/commentEdit.php?idx=<?=$comments[$i]['boardidx']?>&commentidx=<?=$comments[$i]['idx']?>'" type="button" class="btn btn-sm btn-outline-success" style="margin-left: auto;height:35px; width:50%">Edit</button>
                            <button type="button" class="btn btn-outline-danger" style="margin-left: auto;width:50%; height:35px" onclick="location.href='./comment/commentDelete.php?idx=<?=$comments[$i]['idx']?>'">Del</button>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div style="margin-top:30px">
                <button type="button" class="btn btn-outline-success" style="margin-top: 10px;" id="edit_btn">Edit</button>
                <button type="button" class="btn btn-outline-danger" style="margin-top: 10px;" id="delete_btn">Delete</button>
                <button type="button" class="btn btn-outline-warning" style="margin-top: 10px;" id="list_btn">List</button>
            </div>
        </div>
    </div>
    <script>
        // 이벤트 핸들링을 위한 변수 선언
        const list_btn = document.querySelector('#list_btn');
        const edit_btn = document.querySelector('#edit_btn');
        const modal_text = document.querySelector('#modal-text');
        const delete_btn = document.querySelector('#delete_btn');
        const modal = document.querySelector('#modal');
        const modal_delete = document.querySelector('#modal-delete');
        const modal_cancel = document.querySelector('#modal-cancel');


        // 모달창이 띄워진 후 취소 버튼을 누르면 다시 지워주는 기능
        modal_cancel.addEventListener('click', ()=>{
            modal.classList.remove('show-modal')
        })
        // list 버튼을 누르면 board 페이지로 전환
        list_btn.addEventListener('click', ()=>{
            window.location.href = './board.php';
        });
        // 삭제를 눌렀을 때 모달창의 버튼 글자를 삭제로 변경해주고 deleteAction.php로 이동
        delete_btn.addEventListener('click', () => {
            modal_text.textContent = "삭제";
            modal.classList.add('show-modal');
            modal_text.addEventListener('click', ()=>{
            const delPassword = document.querySelector('#inputPass').value;
            window.location.href = `./deleteAction.php?idx=<?=$row['idx']?>&inputPass=${delPassword}`;
        })
        });
        // 수정을 눌렀을 때 모달창의 버튼 글자를 수정으로 변경해주고 editAction.php로 이동
        edit_btn.addEventListener('click', ()=>{
            modal_text.textContent = '수정';
            modal.classList.add('show-modal');
            modal_text.addEventListener('click', ()=>{
                const editPassword = document.querySelector('#inputPass').value;
                window.location.href = `./edit.php?idx=<?=$row['idx']?>&inputPass=${editPassword}`;
            })
        })
    </script>
</body>
</html>