<?php
//DB接続
require('dbconnect.php');


$sql = "SELECT * FROM `whereis_members`"; 

$stmt = $dbh->prepare($sql);
$stmt->execute();
 
$login_menber = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($login_menber['id']);

$sql = "SELECT * FROM `whereis_map` WHERE `member_id`=?";
$data = array($login_menber['id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

    while(1){
      
      $one_movie = $stmt->fetch(PDO::FETCH_ASSOC);

      if($one_movie == false){
        break;
      }else{
        $whereis_map[] = $one_movie;
  
      }
    }
     // echo '<pre>';
     //   var_dump($whereis_map);
     // echo '</pre>';

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Page</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/form.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/timeline.css" rel="stylesheet"> -->
    <link href="css/profile_tmp.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- <link rel="styleseet" type="text/css" href="assets/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="profile.css"> -->
    <!-- header -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navi.css" />
    <link rel="stylesheet" href="css/hero.css" />
    <script type="text/javascript" src="js/footerFixed.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<header>
    <a class="navbar-brand logo" href="#"></a>
    <div class=" topnav" id="myTopnav">
      <a href="index.html">Logout</a>
      <a href="contact.html">Contact</a>
      <a class="active" href="profile.html">MyPage</a>
      <a href="post.html">POST</a>
      <a href="json_map.html">*MAP*</a>
      <a href="javascript:void(0);" style="font-size:30px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>

  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3 content-margin-top">
        <!--<div class="col-xs-6 col-md-offset-3 content-margin-top">-->
        <legend class="profile_title">Profile</legend>
        <form id="update" method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
          <!-- Nick Name -->
          <div class="form-group">
            <label class="col-sm-3 control-label">Nick Name</label>
            <div class="col-sm-8">
              <input type="text" name="nick_name" class="form-control" value="<?php echo $login_menber["nick_name"]; ?>">
              <!-- <input type="text" name="nick_name" class="form-control" value="<?//php echo $whereis_members["nick_name"]; ?>"> -->
              <!-- <input type="text" name="nick_name" class="form-control" placeholder="例： Ryo Tamura" value=""> -->
              <!--<?php// if ((isset($error["nick_name"]) && ($error["nick_name"]) == 'blank')){ ?>-->
              <!--<p class="error">* Please Enter Your Nick Name</p>-->
              <!--<?php// } ?>-->
            </div>
          </div>

          <!-- Email Address -->
          <div class="form-group">
            <label class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control" value="<?php echo $login_menber["email"]; ?>">
              <!-- <input type="email" name="email" class="form-control" placeholder="例： ryotamura@nexseed.com" value=""> -->
              <!--<?php //if ((isset($error["email"]) && ($error["email"]) == 'blank')){ ?>-->
              <!--<p class="error">* Emailを入力してください。</p>-->
              <!--<?php// } ?>-->

               <!--<?php //if ((isset($error["email"]) && ($error["email"]) == 'duplicated')){ ?>-->
              <!--<p class="error">* Please Enter Your Nick Name</p>-->
              <!--<?php //} ?>-->
            </div>
          </div>

          <div class="submit_button">
           <input id="btn-submit" type="submit" class="btn btn-default" value="Update Profile">
           <!-- <button class="preview btn btn-default" onclick="popup();"> -->
           <!-- </button> -->
          </div>
          <div class="submit_button">
            <a href="changepw.html" class="btn btn-default">Change Password</a>
            <!-- <input type="submit" class="btn btn-default" value="Change Password"> -->
          </div>
        </form>
      </div>
   </div>
 </div>



<!-- 連想配列のキーがカラム名と同じものにテーブルのカラム名と同じものをかく予定）-->
<div class="container">
  <div class="row">
    <div class="messages-table">
      <div class="messages text-center">
        <div class="messages-top">
              <br>
              <!--<?php //echo 01; ?>
              <hr>
              <br><br>-->
                <!-- <img src="http://c85c7a.medialib.glogster.com/taniaarca/media/71/71c8671f98761a43f6f50a282e20f0b82bdb1f8c/blog-images-1349202732-fondo-steve-jobs-ipad.jpg" width="100" height="100"> -->
                <!-- <iframe width="854" height="480" src="https://www.youtube.com/embed/jfe3TA4-PgU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                <iframe width="240" height="135" src="https://www.youtube.com/embed/jfe3TA4-PgU?ewl=0" frameborder="0"></iframe>
                  <form id="delete" method="post">
                    <br>
                    <!-- 投稿場所 -->
                    <a href="#">南極</a>
                    <!-- 投稿日時 -->
                    <a href="#">[2018-01-25]</a><br>
                    <input id="btn-delete" type="button" class="btn btn-default" value="削除">
                    <!-- <input id="btn-delete" type="button" value="削除" onclick="window.confirm('こちらの投稿を削除しますがよろしいですか？')"> -->
                    <br><br>
                  </form>
        </div>
      </div>
    </div>


      <?php for($i=0; $i < count($whereis_map); $i++) { ?>
      <div class="messages-table">
        <div class="messages text-center">
          <div class="messages-top">
              <br>
              <!--<?php //echo 01; ?>
              <hr>
              <br><br>-->
                <!-- <img src="http://c85c7a.medialib.glogster.com/taniaarca/media/71/71c8671f98761a43f6f50a282e20f0b82bdb1f8c/blog-images-1349202732-fondo-steve-jobs-ipad.jpg" width="100" height="100"> -->
                <!-- <iframe width="854" height="480" src="https://www.youtube.com/embed/Kyk2pfEt_w4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                <iframe width="240" height="135" src="<?php echo $whereis_map[$i]["movie_info"]; ?>" frameborder="0" ></iframe>
                <!-- <iframe width="240" height="135" src="https://www.youtube.com/embed/Kyk2pfEt_w4?rel=0" frameborder="0" ></iframe> -->
              <form method="post">
                  <br>
                  <!-- 投稿場所 -->
                  <a>バングラデシュ</a>
                  <!-- 投稿日時 -->
                  <a>[2018-01-25]</a><br>
                  <input type="button" value="削除" onclick="window.confirm('こちらの投稿を削除しますがよろしいですか？')">
                  <br><br>
              </form>
          </div>
        </div>
      </div>
      <?php }?>


      <div class="messages-table">
        <div class="messages text-center">
          <div class="messages-top">
              <br>
              <!--<?php //echo 01; ?>
              <hr>
              <br><br>-->
                <!-- <img src="http://c85c7a.medialib.glogster.com/taniaarca/media/71/71c8671f98761a43f6f50a282e20f0b82bdb1f8c/blog-images-1349202732-fondo-steve-jobs-ipad.jpg" width="100" height="100"> -->
                <!-- <iframe width="854" height="480" src="https://www.youtube.com/embed/g4rB2hORVes" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                <iframe width="240" height="135" src="https://www.youtube.com/embed/g4rB2hORVes?rel=0" frameborder="0" ></iframe>
              <form method="post">
                  <br>
                  <!-- 投稿場所 -->
                  <a href="#">セブ</a>
                  <!-- 投稿日時 -->
                  <a href="#">[2018-01-25]</a><br>
                  <input type="button" value="削除" onclick="window.confirm('こちらの投稿を削除しますがよろしいですか？')">
                  <br><br>
              </form>
          </div>
        </div>
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
  <script>
    $(document).on('click', '#btn-submit', function(e) {
         e.preventDefault();
          popup();
    });

    // 関数で一つにまとめる
    function popup() {

      // optionsの中身を設定 = ボタンを押した時に出るダイアログ
      var options = {
        title: "プロフィール情報を変更しますか",
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
              text: "プロフィール情報が変更されました",
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

        $(document).on('click', '#btn-delete', function(d) {
         d.preventDefault();
          d_popup();
    });

    //Post Delete 南極部分のみ
    // 関数で一つにまとめる
    function d_popup() {

      // optionsの中身を設定 = ボタンを押した時に出るダイアログ
      var d_options = {
        title: "南極[2018-01-25]を削除しますか?",
        icon: "info",
        buttons: {
          cancel: "Cancel", // キャンセルボタン
          ok: true
        }
      };

      // この関数がコールバック処理をしている
      swal(d_options)
        // then() メソッドを使えばクリックした時の値が取れます
        .then(function(del) {
          console.log(del)
          if (del) {
            // Okボタンが押された時の処理
            // この中でコールバック処理をしている
            swal({
              text: "南極[2018-01-25]を削除しました",
              icon: "success",
            });
        // submitされた何秒後に自動的に閉じる
              setTimeout(
                function(){
                  // ()の中はformのidからきている #myform #はidを指定する時に使い、. はclassを指定する時に使う
               $('#delete').submit();
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
  </script>
</body>
</html>