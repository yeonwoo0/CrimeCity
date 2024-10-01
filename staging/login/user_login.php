<?php
    session_start();
    if(isset($_SESSION["login"])) {
        echo "<script>alert('이미 로그인이 되어있습니다.');history.back(-1);</script>";
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../utils/main.css">
    <link rel="stylesheet" href="../utils/common.js">
    <title>Login</title>
</head>
<body cellpadding="0" cellspacing="0" marginleft="0" margintop="0" width="100%" height="100%" align="center" style="background-color: #999">
    <div>
        <div class="card align-middle" style="width:20rem; border-radius:20px; margin:auto; margin-top:100px; background-color: whitesmoke">
            <div class="card-title" style="margin-top:30px;">
                <h2 class="card-title text-center" style="color:black;">Login Page</h2>
            </div>
            <div class="card-body">
                <form class="form-signin" action="./loginAction.php" method="POST" >
                    <input type="text" id="uid" class="form-control" placeholder="ID" required autofocus name="uid" autocomplete="off"><BR>
                    <input type="password" id="upw" class="form-control" placeholder="Password" required name="upw" autocomplete="off"><br>
                    <input type="hidden" name="gubun" value="user">
                    <div style="color: red; text-align: center; margin-bottom: 20px; display:none" id="wrong_pw">Wrong Identity !</div>
                    <button id="btn_login" class="btn btn-lg btn-primary btn-block" type="submit" style="background-color : #333; border: none;">Login</button>
                    <button id="btn_reg" class="btn btn-lg btn-primary btn-block" type="button" style="background-color: #333; border: none;" onclick="location.href='register.php';">Register</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>
