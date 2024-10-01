<?php
    session_start();
    include "lib.php";
    include "../utils/common.php";

    # 로그인한 유저의 패스워드를 가져오기 위해 DBMS로부터 쿼리를 가져옴
    if(isset($_SESSION['login'])){
        $query = "SELECT * FROM users WHERE hash = ?";
        $stmt = $db_conn->prepare($query);
        $stmt->bind_param("s", $_SESSION['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        $num = $result->num_rows;
        $row = $result->fetch_assoc();
    }

    // 기본 정렬 기준 설정
    $default_sort_column = 'idx';
    $default_sort = 'DESC';

    // 사용자 입력의 유효성 검사 및 SQL Injection 방지
    //$allowed_columns = ['idx', 'title', 'writer', 'regdate']; // 허용되는 열 목록
    $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : $default_sort_column;
    $sort = isset($_GET['sort']) ? strtoupper($_GET['sort']) : $default_sort;
    
    $limit = 5;
    $page_limit = 5;
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    // if (preg_match("/^[0-9]*$/", $page) ==0){
    //     echo "<script>alert('해킹시도 확인. 반복 시 IP가 차단됩니다.');history.back(-1)</script>";
    // }
    $start_page = ($page -1) * 5;
    $query = "SELECT count(*) as cnt FROM board"; // 별칭을 추가하여 필드 이름을 명시적으로 정의합니다.
    $stmt = $db_conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result(); // 결과 집합을 가져옵니다.
    $row = $result->fetch_assoc(); // 결과를 연관 배열로 가져옵니다.
    $total = $row['cnt']; // 결과를 사용합니다.
    
    # 상단에 있는 검색 기능을 사용했을 때 title 컬럼으로부터 입력값을 가져옴
    if (isset($_GET['nev_search'])){
        $nev_search = $_GET['nev_search'];
        $query = "SELECT * FROM board WHERE title like '%" . $nev_search . "%' LIMIT $start_page, 5";
        $result = $db_conn->query($query);
        $num = ($result && $result->num_rows) ? $result->num_rows : 0;        
    }
    # 조건문으로 사용하지 않는다면 기본적으로 쿼리를 날리기 때문에 상단검색창, 디폴트, board검색창 사용을 조건문으로 분할
    else if(isset($_POST['search_type'])){
        // 검색 유형과 검색어 가져오기
        $search_type = $_POST['search_type'];
        $keyword = $_POST['keyword'];
        // SQL 쿼리 및 바인딩 변수 설정
        if ($search_type == 'all'){
            $query = "SELECT * FROM board WHERE title LIKE '%" . $keyword . "%' OR writer LIKE '%" . $keyword . "%' OR content LIKE '%" . $keyword . "%' limit $start_page,5";
            
        } else if($search_type == 'title'){
            $query = "SELECT * FROM board WHERE title LIKE '%" . $keyword . "%' limit $start_page, 5";
        } else if($search_type == 'writer'){
            $query = "SELECT * FROM board WHERE writer LIKE '%" . $keyword . "%' limit $start_page, 5";
        } else if($search_type == 'content'){
            $query = "SELECT * FROM board WHERE content LIKE '%" . $keyword . "%' limit $start_page, 5";
        } else {
            // 올바르지 않은 검색 유형에 대한 처리
            echo "검색 유형을 확인할 수 없습니다.";
            exit(); // 프로그램 종료
        }
        $result = $db_conn->query($query);
        $num = ($result && $result->num_rows) ? $result->num_rows : 0;
    }else {
        // SQL 쿼리 실행
        $query = "SELECT * FROM board ORDER BY $sort_column $sort limit $start_page, 5";
        $result = $db_conn->query($query);
        $num = ($result && $result->num_rows) ? $result->num_rows : 0;

        $search_type =  isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

        $keyword = str_replace(array("'",'"',"<",">",";","/","\\","*"),'', $keyword);
        if(!preg_match("/^[0-9a-zA-Z]*$/", $search_type)){
            echo "<script>alert('Check for hacking attempts. IP will be blocked if repeated.');history.back(-1);</script>";
            exit;
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
        <div style="width: 80%; margin: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%; text-align:center"><a href="./board.php?sort_column=idx&sort=asc" style="text-decoration: none; color: black">Index ▼</a></th>
                        <th scope="col" style="width: 50%"><a href="./board.php?sort_column=title&sort=asc" style="text-decoration: none; color: black">Title ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./board.php?sort_column=writer&sort=asc" style="text-decoration: none; color: black">Writer ▼</a></th>
                        <th scope="col" style="width: 20%"><a href="./board.php?sort_column=regdate&sort=asc" style="text-decoration: none; color: black">Date ▼</a></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    // 조건문을 통해서 password가 관리자 패스워드와 일치하면 공지게시글로 전환
                        if($num !=0){
                            while($row = $result->fetch_assoc())
                                if($row['password'] == 'NoBruteForce'){
                    ?>
                    <tr>
                        <th style="text-align: center;">[공지]</th>
                        <th><a href="./view.php?idx=<?=$row['idx']?>" style="color: black; text-decoration: none"><?=$row['title']?></a></th>
                        <th>관리자</th>
                        <th><?=date('Y-m-d', strtotime($row["regdate"]))?></th>
                    </tr>
                    <?php
                    // 관리자와 일치하지 않는다면 일반 게시글로 전환
                            }else{
                    ?>
                    <tr>
                        <td style="text-align: center"><?=$row["idx"]?></td>
                        <td><a href="./view.php?idx=<?=$row["idx"]?>" style="color: black; text-decoration: none"><?=$row["title"]?></a></td>
                        <td><?=$row["writer"]?></td>
                        <td><?=date('Y-m-d', strtotime($row["regdate"]))?></td>
                    </tr>
                    <?php
                            }
                        }
                        else {
                    ?>
                    <tr>
                        <td colspan="4">Posts does not exist.</td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <form id="searchForm" method="post" action="./board.php">
                <div class="input-group mb-3">
                    <div class="col-auto my-1" style="margin-right: 10px">
                        <select name="search_type" id="inlineFormCustomSelect" class="form-select form-select-sm" aria-label="Small select example">
                            <option value="all" selected>All</option>
                            <option value="title">Title</option>
                            <option value="writer">Writer</option>
                            <option value="content">Content</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="Keyword Input" name="keyword" id="search_input" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <?php
                if(isset($nev_search)){
                    $show_keyword = $nev_search;
                }else if(isset($keyword)){
                    $show_keyword = $keyword;
                }
                if ($show_keyword !=''){
            ?>
            <div class="alert alert-success  alert-dismissible fade show" role="alert">
                <strong>"<?=$show_keyword?>"에 대한 검색 결과입니다.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
            <div style="display: flex; justify-content: space-between;">
                <?php
                    $rs_str = my_pagination($total, $limit, $page_limit, $page);
                    echo $rs_str;
                ?>
                <button type="button" class="btn btn-outline-success" onclick="redirectToWritePage()" style="height:40px">Write</button>
            </div>
        </div>
    </div>
        <script>
            function redirectToWritePage() {
                window.location.href = "./write.php";
            }
        </script>
</body>
</html>
