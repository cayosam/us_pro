
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
 <a class="navbar-brand logo" href="#"></a>
    <div class=" topnav" id="myTopnav">
     

      <a href="javascript:void(0);" style="font-size:30px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>



  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-xs-offset-3 content-margin-top">
        <legend class="profile_title">Change Password</legend>

              <br>
              <div class="submit_button col-xs-offset-3">
                <input id="btn-submit" type="submit" class="btn btn-default" value="Change Password">
              </div>

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
  <script>
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
  </script>
</body>
</html>
