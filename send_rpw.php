<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Send Email Reset Password</title>
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
        <legend class="profile_title">Send Email Reset Password</legend>
          <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">

          <!-- Explaination -->
            <br><br>
            <p>メールアドレス宛に、パスワード変更ページのURLが記載されたメールを送信しました。
            </p>
            <br>
            <p>しばらくたってからメールボックスをご確認くださいませ。
            <div class="submit_button">
              <a href="index.php" class="btn btn-default">Return Top Page</a>
              <!-- <input type="submit" class="btn btn-default" value="Return Top Page"> -->
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
