<?php

require("dbconnect.php");

  if(isset($_POST) && !empty($_POST)){

    $sql = "SELECT * FROM `whereis_members` WHERE `email` = ?";
    $data = array($_POST["email"]);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    $str_reset_pw = $member["email"] + $$member["modified"];
    $reset_sql = "UPDATE `whereis_members` SET `password`= ? WHERE `email`";
    $reset_data = array(sha1($str_reset_pw),$member["email"]);
    $reset_stmt = $dbh->prepare($reset_sql);
    $reset_stmt->execute($reset_data);

    $reset_url = "http://localhost/us_pro/changepw.php/code=".sha1($str_reset_pw);
    $mail_body = "パスワードを再設定するため、下記リンクを押してください。";
    $mail_body .=$reset_url;
    $email = $member["email"];
    $title = "WHERE IS * よりパスワード再設定のお知らせ";
    $mail_head = "From:p100slp33@yahoo.co.jp";
    $mail_body = html_entity_decode($email_body,ENT_QUOTES,"UTF_8");
    //文字化け対策
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail($email,$title,$mail_body,$mail_head);

    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset My Password</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">-->
    <!-- <link href="assets/css/form.css" rel="stylesheet"> -->
    <!--<link href="assets/css/timeline.css" rel="stylesheet">-->
<!--    <link href="css/profile_tmp.css" rel="stylesheet">-->
    <link href="css/profile.css" rel="stylesheet">
    <!--<link rel="styleseet" type="text/css" href="assets/css/bootstrap.css">-->
    <!-- header -->
    <script type="text/javascript" src="js/footerFixed.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navi.css" />
    <link rel="stylesheet" href="css/hero.css" />
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
        <legend class="profile_title">Reset My Password</legend>
          <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
          <!-- password -->
            <div class="form-group">
            <label class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-8">
            <input type="email" name="email" class="form-control" placeholder="例： ryotamura@nexseed.com" value="">
              <!--<p class="error">* Please Enter Your Emairl Address</p>-->
            </div>
            </div>
          <!-- Explaination -->
            <br><br>
              <P>パスワードを忘れた場合</P>
            <br><br>
            ご登録いただいたメールアドレスを入力してください。
            <br><br>
            <p>メールアドレス宛に、パスワード変更ページのURLが記載されたメールを送信します。
            </p>
            <div class="submit_button">
            <a href="send_rpw.php" class="btn btn-default">Send Email</a>
            <!-- <input type="submit" class="btn btn-default" value="Send Email"> -->
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
</body>
</html>
