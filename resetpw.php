<?php
session_start();

//DB接続
require('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change Password</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">-->
    <!-- <link href="assets/css/form.css" rel="stylesheet"> -->
    <!--<link href="assets/css/timeline.css" rel="stylesheet">-->
    <!-- <link href="profile.css" rel="stylesheet" type="text/css"> -->

    <script type="text/javascript" src="js/footerFixed.js"></script>
    <!-- header -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navi.css" />
    <link rel="stylesheet" href="css/hero.css" />
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<header>
 <a class="navbar-brand logo" href="index.php"></a>
    <div class=" topnav" id="myTopnav">

      <a href="logout.php">Logout</a>
      <a class="active" href="profile.php">MyPage</a>
      <a href="post.php">POST</a>
      <a href="help.php">Help</a>     
      <a href="contact.php">Contact</a>
      <a href="json_map.php">*MAP*</a>
      <a href="javascript:void(0);" style="font-size:30px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>



  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3 content-margin-top">
        <legend class="profile_title">Reset Password</legend>
          <form id="update" method="post" action="join/resetpw1.php" class="form-horizontal" role="form" enctype="multipart/form-data">
            
            <!-- NickName -->
              <div class="form-group">
                <label for="username" class="col-sm-4 control-label">NickName</label>
                  <div class="col-sm-8">
                    <input id="username" type="text" name="username" class="form-control" >
                  </div>
              </div> 
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 1)) { ?>
                        <p class="error">ニックネームを入力してください。</p>
                        <?php } ?>

             <!-- Email -->
              <div class="form-group">
                <label for="email1" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-8">
                    <input id="email1" type="email" name="email1" class="form-control" value="">
                  </div>
              </div>
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 2)) { ?>
                        <p class="error">Emailを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 8)) { ?>
                        <p class="error">ニックネームまたはEmailが正しく入力されていません。</p>
                        <?php } ?>  

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 7)) { 
                          // changepwに移動
                          header("Location: changepw.php");
                          exit();
                          ?>
                        
                        <?php } ?>  


              <br>
              <div class="submit_button col-xs-offset-3">
                <input id="btn-submit" type="submit" class="btn btn-default" value="Reset Password">
              </div>
                        <div class="result"></div>
                        <script type="text/javascript">

                        $(function(){
                        //submitしたときの挙動
                        $('#update').on('submit',function(e){
                            e.preventDefault();
                            //Submitが押されたら
                            $.ajax({
                                url:'join/resetpw1.php',
                                type:'POST',
                                data:{
                                    'username':$('#username').val(),
                                    'email1':$('#email1').val(),
                                    'save':$('#remember').val()
                                }
                            })
                            .done(function(data){
                                $('.result').html(data);
                                console.log(data);
                            })
                            .fail(function(){
                                $('.result').html(data);
                                console.log(data);
                            });
                        });

                        $('#ajax').on('click',function(){
                            $.ajax({
                                url:'join/resetpw1.php',
                                type:'POST',
                                data:{
                                    'username':$('#username').val(),
                                    'email1':$('#email1').val(),
                                    'save':$('#remember').val()
                                }
                            })
                            .done(function(data){
                                $('.result').html(data);
                                console.log(data);
                            })
                            .fail(function(data){
                                $('.result').html(data);
                                console.log(data);
                            });
                        });
                    });
                </script>
          </form>
      </div>
    </div>
  </div>

  <div id="footer" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-2"></div>
          <div class="col-sm-8 webscope">
            <span class="webscope-text"> The world view by </span>
            <a href=""> <img src="img/logo04.png"/> </a>
          </div>
        <div class="col-sm-2"></div>
      </div>
    </div>
  </div>

<script src="js/navi.js"> </script>

</body>
</html>
