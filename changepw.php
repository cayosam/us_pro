<!-- <?php
session_start();

//DB接続
require('dbconnect.php');
var_dump($_SESSION["id"]);
?> -->

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
    <a href="help.php">Help</a>
      <a href="contact.php">Contact</a>
      <a href="json_map.php">*MAP*</a>
      <a href="javascript:void(0);" style="font-size:30px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>



  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3 content-margin-top">
        <legend class="profile_title">Change Password</legend>
          <form id="update" method="post" action="join/changepw1.php" class="form-horizontal" role="form" enctype="multipart/form-data">
            <!-- old password -->
              <div class="form-group">
                <label for="oldpw" class="col-sm-4 control-label">Old Password</label>
                  <div class="col-sm-8">
                    <input id="oldpw" type="password" name="oldpw" class="form-control" >
                  </div>
              </div> 
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 1)) { ?>
                        <p class="error">古いパスワードを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 2)) { ?>
                        <p class="error">古いパスワードは、4文字以上入力してください。</p>
                        <?php } ?>  

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 8)) { ?>
                        <p class="error">古いパスワードが正しく入力されていません。</p>
                        <?php } ?>  

             <!-- new password -->
              <div class="form-group">
                <label for="newpw" class="col-sm-4 control-label">New Password</label>
                  <div class="col-sm-8">
                    <input id="newpw" type="password" name="newpw" class="form-control" value="">
                  </div>
              </div>
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 3)) { ?>
                        <p class="error">新しいパスワードを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 4)) { ?>
                        <p class="error">新しいパスワードは、4文字以上入力してください。</p>
                        <?php } ?>  



              <!-- confirm password -->
              <div class="form-group">
                <label for="confirmpw" class="col-sm-4 control-label">Confirm Password</label>
                  <div class="col-sm-8">
                    <input id="confirmpw" type="password" name="confirmpw" class="form-control" value="">
                  </div>
              </div>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 5)) { ?>
                        <p class="error">確認パスワードを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 6)) { ?>
                        <p class="error">確認パスワードは、4文字以上入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 7)) { ?>
                          <p class="error">* 入力された新しいパスワードと確認パスワードが一致しません。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 9)) { ?>
                          <p class="error">* パスワードが正常に変更されました。</p>
                        <?php } ?>


              <br>
              <div class="submit_button col-xs-offset-3">
                <input id="btn-submit" type="submit" class="btn btn-default" value="Change Password">
              </div>
                        <div class="result"></div>
                        <script type="text/javascript">

                        $(function(){
                        //submitしたときの挙動
                        $('#update').on('submit',function(e){
                            e.preventDefault();
                            //Submitが押されたら
                            $.ajax({
                                url:'join/changepw1.php',
                                type:'POST',
                                data:{
                                    'oldpw':$('#oldpw').val(),
                                    'newpw':$('#newpw').val(),
                                    'confirmpw':$('#confirmpw').val(),
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
                                url:'join/changepw1.php',
                                type:'POST',
                                data:{
                                    'oldpw':$('#oldpw').val(),
                                    'newpw':$('#newpw').val(),
                                    'confirmpw':$('#confirmpw').val(),
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

  <!-- 問題 -->
  <!-- ポイント2つ -->
  <!-- form、inputにidをつける -->
  <!-- 関数でまとめる -->
  <!-- Change Profile -->
<!--   <script>
    $(document).on('click', '#btn-submit', function(e) {
         e.preventDefault();
          popup();
    });

    // 関数で一つにまとめる
    function popup() {

      // optionsの中身を設定 = ボタンを押した時に出るダイアログ
      var options = {
        title: "パスワードを変更しますか",
        icon: "info",
        buttons: {
          cancel: "Cancel", // キャンセルボタン
          ok: true
        }
      };

      // この関数がコールバック処理をしている
      swal(options)
        // then() メソッドを使えばクリックした時の値が取れます
        .then(function(val) {
          console.log(val)
          if (val) {
            // Okボタンが押された時の処理
            // この中でコールバック処理をしている
            swal({
              text: "パスワードが変更されました",
              icon: "success",
            });
        // submitされた何秒後に自動的に閉じる
              setTimeout(
                function(){
                  // ()の中はformのidからきている #myform #はidを指定する時に使い、. はclassを指定する時に使う
               $('#update').submit();
              },2000);

          } else {
            // キャンセルボタンを押した時の処理
            // この中でコールバック処理をしている
            // valには 'null' が返ってきます
            swal({
              text: "キャンセルされました",
              icon: "warning",
              buttons: false,
              timer: 2500 // 2.5秒後に自動的に閉じる
            });
          }
      });
    }
  </script> -->
</body>
</html>
