<?php
session_start();

//DB接続
require('dbconnect.php');
var_dump($_SESSION["id"]);

  // if (isset($_POST["id"]) && empty($_POST["nick_name"]) && $_GET["error"] == 1) {
    
  //   header("Location: profile.php?error=1");
  //   exit();
  // }


  $sql = "SELECT * FROM `whereis_members` WHERE `id`=".$_SESSION["id"];
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $login_member = $stmt->fetch(PDO::FETCH_ASSOC);

  // var_dump($login_member['id']);


  if(isset($_POST["nick_name"]) && !empty($_POST["nick_name"]) || isset($_POST["email"]) && !empty($_POST["email"])){

    $ud_profile_sql = "UPDATE `whereis_members` SET `nick_name`=?,`email`=? WHERE `id`=".$_SESSION["id"];
    $ud_profile_data = array($_POST['nick_name'],$_POST['email']);
    $ud_profile_stmt = $dbh->prepare($ud_profile_sql);
    $ud_profile_stmt->execute($ud_profile_data);

    header("Location: profile.php?member_id".$_GET["member_id"]);
    exit();
  }


  $movie_sql = "SELECT * FROM `whereis_map` WHERE `member_id`=".$_SESSION["id"]." ORDER BY `created` DESC ";
  $movie_data = array($login_member['id']);
  $movie_stmt = $dbh->prepare($movie_sql);
  $movie_stmt->execute($movie_data);

       // var_dump($movie_sql);
       // var_dump($movie_data);

  $whereis_map = array();
      while(1){

        $one_movie = $movie_stmt->fetch(PDO::FETCH_ASSOC);
          //var_dump($one_movie);
        if($one_movie == false){
          break;
        }else{
          $whereis_map[] = $one_movie;
       // echo '<pre>';
         //var_dump($whereis_map);
       // echo '</pre>';
        }
      }
       // echo '<pre>';
       //   var_dump($one_movie);
       // echo '</pre

  if(isset($_GET["id"]) && !empty($_GET["id"])){

    $delete_movie = $_GET["id"];
    
    $del_sql = "DELETE FROM `whereis_map` WHERE `id`=".$delete_movie;
    $del_stmt = $dbh->prepare($del_sql);
    $del_stmt ->execute();

    header("Location: profile.php?member_id".$_GET["member_id"]);
    exit();
  }

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
        <legend class="profile_title">Profile</legend>
        <form id="update" method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
          <!-- Nick Name -->
          <div class="form-group">
            <label for="nick_name1" class="col-sm-3 control-label">Nick Name</label>
            <div class="col-sm-8">
              <input id="nick_name" type="text" name="nick_name" class="form-control" value="<?php echo $login_member["nick_name"]; ?>">
            </div>
          </div>

          <!-- Email Address -->
          <div class="form-group">
            <label class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control" value="<?php echo $login_member["email"]; ?>">
            </div>
          </div>

          <div class="submit_button">
           <input id="" type="submit" class="btn btn-default" value="Update Profile">

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
      <?php foreach ($whereis_map as $one_movie) { ?>
      <div class="messages-table">
        <div class="messages text-center">
          <div class="messages-top">
              <br>

                <div> <?php echo $one_movie["movie_info"]; ?></div>

                
                  <a><?php echo $one_movie["address"];?></a>
                  <!-- 投稿日時 -->
                  <a>
                  <?php
                  $created_date = $one_movie["created"];
                  //strtotime 文字型のデータを日時型に変換できる
                  //(Y年m月d日 と記述することも可能)(H24時間表記、h12時間表記)
                  $created_date = date("Y-m-d H:i",strtotime($created_date));
                  echo $created_date;
                  ?>
                  </a><br>
                    <input id="btn-delete"<?php echo $one_movie["id"]; ?> type="button" class="btn btn-default delete" value="削除" data-add="<?php echo $one_movie["address"];?>">
                    <!-- <a href="profile.php?id=<?php  echo $one_movie["id"]; ?>"><input id="btn-delete" type="button" class="btn btn-default" value="削除"></a> -->


                  <br><br>
                </form>
          </div>
        </div>
      </div>
      <?php }?>
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

         console.log(d);
          d_popup("aaaa");
    });

    //Post Delete
    // 関数で一つにまとめる
    function d_popup(titletext) {

      // optionsの中身を設定 = ボタンを押した時に出るダイアログ
      var d_options = {
        // title: "<?php //echo $one_movie["address"]; ?>[2018-01-25]を削除しますか?",
        title: titletext,
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
              // text: "<?php //echo $one_movie  ["address"]; ?>[2018-01-25]を削除しました",
              text: titletext,
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

<script src="js/warning_form.js"></script>

</body>
</html>