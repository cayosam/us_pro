<?php
//ログイン認証機能

// DBに接続
require('dbconnect.php');


// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST) && !empty($_POST)) {


  //ニックネームが空っぽだったら$errorというエラー情報を格納する変数に
  // 入力チェック
    if ($_POST["username"] == '') {

      $error["username"] = 'blank';
    }
      // var_dump($error["email"]);

  // emailはblankだったというマークを保存しておく
    if ($_POST["email"] == '') {

      $error["email"] = 'blank';

    }

      // var_dump($error["email"]);  


  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["password"] == '') {
      $error["password"] = 'blank';
    }else if (strlen($_POST["password"]) < 8) {
      $error["password"] = 'length';
    }


  // 入力チェック後、エラーが何もなければ、移動
    // $errorが存在していなかったら入力が正常と認識
    if (!isset($error)){

  // 認証処理
  try {
    //メンバーズテーブルでテーブルの中からメールアドレスとパスワードが入力されたものと合致する
    // データを取得
    $login_sql = "SELECT COUNT(*) as `cnt` FROM `whereis_members` WHERE `email`=?";

    //SQL文実行
    // パスワードは、入力されたものを暗号化した上で使用する
    $login_data = array($_POST["email"]);
    $login_stmt = $dbh->prepare($login_sql);
    $login_stmt->execute($login_data);

        // 件数取得
    $count = $login_stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['cnt'] > 0) {
          # 重複エラー
          $error["email"] = "duplicated";

    //1行取得

    // var_dump($member);
    // var_dump($login_sql);

    }else{
      // 認証成功
      // 1.セッション変数に、会員のidを保存
      // $_POST["id"] = $member["member_id"];

      // 2.ログインした時間をセッション変数の保存
      // $_POST["time"] = time();

      // // 3.自動ログインの処理
      // if ($_POST["save"] == "on"){
      //   //クッキーにログイン情報を記録
      //   // setcookie(保存したい名前,保存したい値,保存したい期間：秒数)
      //   setcookie('email',$_POST["email"], time()+60*60*24*14);
      //   setcookie('password',$_POST["password"], time()+60*60*24*14);

      // }

      // 4.ログイン後の画面に移動
      // header("Location: post.html");


      exit();
    }

  } catch (Exception $e) {
    
  }
}

}

?>
<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Where is *(アスタリスク)</title>
    <meta name="Nova theme" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/login.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>
<script type="text/javascript">
   $(document).ready(function(){
    $('.loginpanel').hide();   
    $('.kaiintouroku').show();
    });
</script>


    <!-- Navigation
    ================================================== -->
<div class="hero-background">

    <img class="strips" src="earth.png">

    <div class="container">
        <div class="header-container header">
            <div class="header-right">
                <a class="navbar-item" href="contact.html">Contact</a>
            </div>
        </div>
        <!--end of navigation-->

        <div class="hero row">
            <div class="hero-right col-sm-6 col-sm-6">
                <h1 class="header-headline bold"> 世界の景色をお手軽に <br></h1>
                <h4 class="header-running-text light"> You can see so easy the view of the world. </h4>
            </div>

            <form method="POST" action="">
                <div class="col-sm-6 col-sm-6 ">
                    <div class="loginpanel">
                        <div class="txt">
                            <input id="user6" type="text" placeholder="E-mail" name="login_email" />
                            <label for="user" class="entypo-mail"></label>                           
                  <?php if ((isset($error["login_email"])) && ($error["login_email"]== 'blank')) { ?>
                  <p class="error">* Eメールを入力してください。</p>
                  <?php } ?>

                        </div>
                  <div class="txt">
                            <input id="pwd7" type="password" placeholder="Password" name="login_password" />
                            <label for="pwd" class="entypo-lock"></label>
                  <?php if ((isset($error["login_password"])) && ($error["login_password"]== 'blank')) { ?>
                  <p class="error">* パスワードを入力してください。</p>
                  <?php } ?>

                  <?php if ((isset($error["login_password"])) && ($error["login_password"]== 'length')) { ?>
                   <p class="error">* パスワードは、8文字以上入力してください。</p>
                  <?php } ?>

                  <?php if (isset($error["login"]) == 'failed') { ?>
                   <p class="error">* E-mailまたはパスワードが間違っています。</p>
                  <?php } ?>
                        </div>
                    <div class="buttons">
                            <input type="submit" value="Login" name="btn" />
                            <span>
                    <a href="javascript:void(0)" class="entypo-user-add" > Register</a>
                    </span>
                        </div>

                  <a href="json_map.html" class="submit_button">
                  <input type="button" value="Visitor" class="submit_button">
                  </a>

                        <div id="forget_pw">
                            <p>passwordを忘れた方は<a href="resetpw.html">こちら</a></p>
                        </div>

                        <div class="hr">
                            <div></div>
                            <div>OR</div>
                            <div></div>
                        </div>
                        <div class="social">
                                <a href="javascript:void(0)" class="googleplus"></a>
                           
                        </div>
                    </div>
                </div>
                </form>
















                <!--新規会員登録-->
                <form method="POST" action="" >
                <div class="col-sm-6 col-sm-6">
                    <div class="kaiintouroku">
                        <font size="3" color="black">
                            <u><strong>
                            <div align="center"><p>新規会員登録</p></div>
                            </strong></u>
                        </font>
                        <div class="txt">
                            <input id="user" type="text" placeholder="NickName" name="username" />
                            <label for="user" class="entypo-user-add"></label>
                        </div>
                         <?php if ((isset($error["username"])) && ($error["username"]== 'blank')) { ?>
                        <p class="error">* ニックネームを入力してください。</p>
                        <?php } ?>

                        <div class="txt">
                         <input id="user1" type="text" placeholder="E-mail" name="email" />
                        <label for="user" class="entypo-mail"></label>
                        <?php if ((isset($error["email"])) && ($error["email"]== 'blank')) { ?>
                        <p class="error">* Eメールを入力してください。</p>
                        <?php } ?>

                        <?php if (($error["email"] = "duplicated")) { ?>
                          <p class="error">* 入力されたEmailは登録済みです。</p>
                        <?php } ?>

                        </div>

                        <div class="txt">
                            <input id="user2" type="text" placeholder="Check E-mail Address" name="email2" />
                            <label for="user" class="entypo-mail"></label>
                        </div>

                        <div class="txt">
                            <input id="pwd1" type="password" placeholder="Password" name=password />
                            <label for="pwd" class="entypo-lock"></label>
                        </div>
                        <?php if ((isset($error["password"])) && ($error["password"]== 'blank')) { ?>
                        <p class="error">* パスワードを入力してください。</p>
                        <?php } ?>

                  <?php if ((isset($error["password"])) && ($error["password"]== 'length')) { ?>
                   <p class="error">* パスワードは、8文字以上入力してください。</p>
                  <?php } ?>

                        <div class="txt">
                            <input id="pwd2" type="password" placeholder="Check Password" name="password2" />
                            <label for="pwd" class="entypo-lock"></label>
                        </div>

                        <div class="txt">
                        </div>

                        
                        <div class="buttons">
                            <!--      <a href="join/index.php"> -->
                        <input type="submit" class="hero-btn2" value="Confirm Account" name="btn1"/>
                        </div>

                    </div>
                </div>
<!--                         <?php if ((isset($error["username"])) && ($error["password"])) { ?>
                        
                        <script type="text/javascript">
                        $(document).ready(function(){
                        $('.loginpanel').hide();
                        $('.hero-btn').hide();
                        $('.kaiintouroku').hide();
                        $('.kaiintouroku2').show();
                      //  $('.social-links').hide();
                      //  $('.webscope').hide();

                      //登録内容確認
                        var user = $("#user").val();
                        $("#nick_name").val(user);

                         var email = $("#user1").val();
                         $("#email").val(email);

                         var pwd = $("#pwd1").val();
                         $("#password").val(pwd);
                        </script>
                        });

                      });
                      <?php } ?> -->
                      ?>
                </form>
                <!--end of 新規会員登録-->












               <!--会員登録確認-->
               <form method="POST" action="join/new.php" >
                <div class="col-sm-6 col-sm-6">
                    <div class="kaiintouroku2">
                        <font size="3" color="black">
                            <u><strong>
                            <div align="center">
                            <p>会員登録確認</p>
                            </div>
                            </strong></u>
                        </font>
                        
                        <div class="txt">
                            <input id="nick_name" type="text" placeholder="NickName" name="nick_name" readonly />
                            <label for="user" class="entypo-user-add"></label>
                        </div>

                        <div class="txt">
                            <input id="email" type="text" placeholder="E-mail" name="email" readonly/>
                            <label for="user" class="entypo-mail"></label>
                        </div>

                        <div class="txt">
                            <input id="password" type="password" placeholder="Password" name="password" readonly/>
                            <label for="pwd" class="entypo-lock"></label>
                        </div>
                        <!--         <div class="buttons"> -->
                        <input type="submit" class="hero-btn2" value="Create Account" name="btn2" />
                    </div>
                </div>
                </form>
                <!--end of 会員登録確認-->




                
        </div><!--end of hero row-->
    </div><!--end of container-->
</div><!--end of hero-background-->

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/input.js"></script>
    <script src="js/login.js"></script>
    <script src="js/script.js"></script>


</body>

</html>