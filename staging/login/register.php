<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
                <h2 class="card-title text-center" style="color:black;">Register Page</h2>
            </div>
            <div class="card-body">
                <form class="form-signin" action="./registerAction.php" method="POST" >
                    <input type="text" id="uid" class="form-control" placeholder="ID" required autofocus name="uid" autocomplete="off"><BR>
                    <input type="password" id="upw" class="form-control" placeholder="Password" required name="upw" autocomplete="off" style="margin-bottom: 0px;"><br>
                    <input type="password" id="upw2" class="form-control" placeholder="Password Confirm" required name="upw" autocomplete="off" style="margin-top: 0px;"><br>
                    <input type="hidden" name="gubun" value="user">
                    <div style="color: red; text-align: center; margin-bottom: 20px; display:none" id="wrong_pw">Wrong Identity !</div>
                    <button id="btn_create" class="btn btn-lg btn-primary btn-block" type="submit" style="background-color : #333; border: none;">Create</button>
                </form>    
            </div>
        </div>
    </div>
        <script>
            const btn_create = document.querySelector('#btn_create');
            btn_create.addEventListener('click', ()=>{
                const upw1 = document.querySelector('#upw').value;
                const upw2 = document.querySelector('#upw2').value;
                if(upw1 == upw2){
                    window.location.href = "../index.php";
                }else if(upw1.length > 14 || upw2.length > 14){
                    alert('패스워드는 14글자 이내로 작성해주세요');
                    event.preventDefault(); // 양식 제출 중단
                }
                else {
                    alert('패스워드를 확인해주세요.');
                    event.preventDefault(); // 양식 제출 중단
                }
            })
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    </body>
    </html>


