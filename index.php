<?php

session_start();

//ログイン認証機能

// DBに接続
require('dbconnect.php');

//test
//test2

//クッキー情報が存在してたら（自動ログイン）
// $_POSTにログイン情報を保存します
if (isset($_COOKIE["email"]) && !empty($_COOKIE["email"])){
  $_POST["login_email"] = $_COOKIE["email"];
  $_POST["login_password"] = $_COOKIE["password"];

}

// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST) && !empty($_POST)) {


  // 入力チェック

  //ニックネームが空っぽだったら$errorsというエラー情報を格納する変数に

  // emailはblankだったというマークを保存しておく
    if ($_POST["login_email"] == '') {

      $error["login_email"] = 'blank';

    }

  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["login_password"] == '') {
      $error["login_password"] = 'blank';
    }else if (strlen($_POST["login_password"]) < 4) {
      $error["login_password"] = 'length';
    }

  // 入力チェック後、エラーが何もなければ、移動
    // $errorが存在していなかったら入力が正常と認識
    if (!isset($error)){

  // 認証処理
  try {
    //メンバーズテーブルでテーブルの中からメールアドレスとパスワードが入力されたものと合致する
    // データを取得
    $login_sql = "SELECT * FROM `whereis_members` WHERE `email`=? AND `password`=?";

    //SQL文実行
    // パスワードは、入力されたものを暗号化した上で使用する
    $login_data = array($_POST["login_email"],sha1($_POST["login_password"]));
    $login_stmt = $dbh->prepare($login_sql);
    $login_stmt->execute($login_data);

    //1行取得
    $member = $login_stmt->fetch(PDO::FETCH_ASSOC);

    if ($member == false){
      // 認証失敗
      $error["login"] = "failed";

    }else{
      // 認証成功
      // 1.セッション変数に、会員のidを保存
      $_SESSION["id"] = $member["id"];

      // 2.ログインした時間をセッション変数の保存
      $_SESSION["time"] = time();

      // 3.自動ログインの処理
      if ($_POST["save"] == "on"){
        //クッキーにログイン情報を記録
        // setcookie(保存したい名前,保存したい値,保存したい期間：秒数)
        setcookie('login_email',$_POST["login_email"], time()+60*60*24*14);
        setcookie('login_password',$_POST["login_password"], time()+60*60*24*14);

      }

      // 4.ログイン後の画面に移動
      header("Location: json_map.php");
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
    <!-- Navigation
    ================================================== -->
<div class="hero-background">

    <img class="strips" src="earth.png">

    <div class="container">
        <div class="header-container header">
            <div class="header-right">
                <a class="navbar-item" href="contact.php">Contact</a>
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
                            <input id="user6" type="email" placeholder="E-mail" name="login_email" />
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
                   <p class="error">* パスワードは、4文字以上入力してください。</p>
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

                  <a href="json_map.php" class="submit_button">
                  <input type="button" value="Visitor" class="submit_button">
                  </a>

                        <div id="forget_pw">
                            <p>passwordを忘れた方は<a href="resetpw.php">こちら</a></p>
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
                <form id="modal-content" method="POST" action="request.php" >
                <div class="col-sm-6 col-sm-6">
                    <div class="kaiintouroku">
                        <font size="3" color="black">
                            <u><strong>
                            <div align="center"><p>新規会員登録</p></div>
                            </strong></u>
                        </font>
                        <div class="txt">
                        <input id="username" type="email" placeholder="NickName" name="nick_name" />
                        <label for="username" class="entypo-user-add"></label>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 3)) { ?>
                         <p class="error">* ユーザネームを入力してください。</p>
                        <?php } ?>
                        </div>
                        
                        <div class="txt">
                         <input id="user1" type="email" placeholder="E-mail" name="email" />
                        <label for="user1" class="entypo-mail"></label>
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 4)) { ?>
                        <p class="error">* Eメールを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 2)) { ?>
                          <p class="error">* 入力されたEmailは登録済みです。</p>
                        <?php } ?>
                        </div>

                        <div class="txt">
                            <input id="email2" type="email" placeholder="Check E-mail Address" name="email2" />
                            <label for="user" class="entypo-mail"></label>
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 7)) { ?>
                          <p class="error">* 入力されたEmailと確認Emailが一致しません。</p>
                        <?php } ?>
                        </div>

                        <div class="txt">
                            <input id="pwd1" type="password" placeholder="password" name="password" />
                            <label for="password" class="entypo-lock"></label>
                        </div>
                        
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 5)) { ?>
                        <p class="error">パスワードを入力してください。</p>
                        <?php } ?>

                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 6)) { ?>
                        <p class="error">パスワードは、4文字以上入力してください。</p>
                        <?php } ?>                        

                        <div class="txt">
                            <input id="password2" type="password" placeholder="Check Password" name="password2" />
                            <label for="pwd" class="entypo-lock"></label>
                        <?php if (isset($_GET["error"]) && ($_GET["error"] == 8)) { ?>
                          <p class="error">* 入力されたパスワードと確認パスワードが一致しません。</p>
                        <?php } ?>
                        </div>

                        <div class="txt">
                        </div>
                        

                        <div class="buttons">
                            <!--      <a href="join/index.php"> -->
                        <input type="submit" id="ajax" class="hero-btn2" value="Confirm Account" />
                        </div>
                        <div class="result"></div>
                        <script type="text/javascript">

                        $(function(){
                        //submitしたときの挙動
                        $('#modal-content').on('submit',function(e){
                            e.preventDefault();
                            //Loginが押されたら
                            $.ajax({
                                url:'request.php',
                                type:'POST',
                                data:{
                                    'username':$('#username').val(),
                                    'email':$('#email').val(),
                                    'email2':$('#email2').val(),
                                    'password':$('#password').val(),
                                    'password2':$('#password2').val(),
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
                                url:'request.php',
                                type:'POST',
                                data:{
                                    'username':$('#username').val(),
                                    'email':$('#email').val(),
                                    'email2':$('#email2').val(),
                                    'password':$('#password').val(),
                                    'password2':$('#password2').val(),
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

                    </div>
                </div>
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
                            <input id="nick_name" type="email" placeholder="NickName" name="nick_name" readonly />
                            <label for="user" class="entypo-user-add"></label>
                        </div>

                        <div class="txt">
                            <input id="email" type="email" placeholder="E-mail" name="email" readonly/>
                            <label for="user" class="entypo-mail"></label>
                        </div>

                        <div class="txt">
                            <input id="password" type="password" placeholder="password" name="password" readonly/>
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


<?php if (isset($_GET["error"]) && ($_GET["error"] > 0)) { ?>

  <script type="text/javascript">
    console.log('error2');
   $(document).ready(function(){
    $('.loginpanel').hide();   
    $('.kaiintouroku').show();
    });
    


  </script>
 
<?php }

?>

</body>

</html>