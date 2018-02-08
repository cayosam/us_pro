<?php
  session_start(); //SESSIONを使うときは絶対に必要

// DBに接続
  require('../dbconnect.php');


  // 書き直し処理（check.phpで書き直し、というボタンが押されたとき）
  if (isset($_GET['action']) && $_GET['action'] == 'rewrite') {

    // 書き直すために初期表示する情報を変数に格納
    $nick_name = $_SESSION['join']['nick_name'];
    $email = $_SESSION['join']['email'];
    $password = $_SESSION['join']['password'];

  }else{

    $nick_name = '';
    $email = '';
    $password = '';
}

// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST) && !empty($_POST)) {


  // 入力チェック

  //ニックネームが空っぽだったら$errorというエラー情報を格納する変数に
  // nick_nameはblankだったというマークを保存しておく
    if ($_POST["nick_name"] == '') {

      $error["nick_name"] = 'blank';

    }

  // emailはblankだったというマークを保存しておく
    if ($_POST["email"] == '') {

      $error["email"] = 'blank';

    }

  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["password"] == '') {
      $error["password"] = 'blank';
    }else if (strlen($_POST["password"]) < 4) {
      $error["password"] = 'length';
    }


  // 入力チェック後、エラーが何もなければ、chack.phpに移動
    // $errorが存在していなかったら入力が正常と認識
    if (!isset($error)){

      // emailの重複チェック
      // DBに同じemailの登録があるか確認
      try {
        // 検索条件にヒットした件数を取得するSQL文
        // COUNT() SQL文の関数。ヒットした数を取得
        // as 別名 取得したデータに別な名前を付けて扱いやすいようにする
        $sql = "SELECT COUNT(*) as `cnt` FROM `members` WHERE `email`=?";

        // sql分実行
        $data = array($_POST["email"]);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // 件数取得
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['cnt'] > 0) {
          # 重複エラー
          $error['email'] = "duplicated";
        }
      } catch (Exception $e) {
        
      }

      if (!isset($error)) {
        # code...
              // 画像の拡張子チェック
      // jpg.png.gifはOK
      // substr・・・文字列から範囲指定して一部分の文字を切り出す関数
      // substr(文字列,切り出す文字のスタートの数)マイナス3の場合は、末尾からn文字目
      // 例) 1.pngがファイル名の場合、$extにはpngが代入される
      $ext = substr($_FILES['picture_path']['name'],-3);

      if (($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif') || ($ext == 'JPG')){
      // 画像のアップロード処理
      // 例）eriko1.pngをユーザが指定したとき、$picture_nameの中身は20171222142530eriko1.pngという文字列が代入されます
      // ファイル名の決定
      $picture_name = date('YmdHis') . $_FILES['picture_path']['name'];

      // upload(ファイルに書き込み権限がないと保存されない)
      // move_uploaded_file(アップロードしたいファイル、serverのどこにどういう名前でuploadするか指定)
      move_uploaded_file($_FILES['picture_path']['tmp_name'], '../picture_path/' . $picture_name);

  //SESSION変数に入力された値を保存する（どこの画面からも利用できる！）
  // 注意！必ずファイルの一番上に、session_start();と書く
  // POST送信された情報をjoinというキーを指定して保存 
      $_SESSION['join'] = $_POST;
      $_SESSION['join']['picture_path'] = $picture_name;

  // check.phpに移動
      header('Location: check.php');

  // これ以下のコードを無駄に処理しないように、このページの処理を終了させる
      exit();

    }else{
      $error['image'] = 'type';
    }

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
    

<!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
-->
          
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/responsive.css"/>
     <link rel="stylesheet" href="css/login.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Ryo added -->
<!-- <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script> -->
<!-- <script type="text/javascript" src="assets/js/jquery.ba-hashchange.min.js"></script>
<script type="text/javascript" src="assets/js/autoConfirm.js"></script> -->
</head>


<body>

<!-- Navigation
    ================================================== -->

<div class="hero-background">
   <div>
      <img class="strips" src="earth.png">
   </div>
      <div class="container">
        <div class="header-container header">


                      <div class="header-right">
                <a class="navbar-item" href="contact.html">Contact</a>
            </div>

            
        </div>
        <!--navigation-->

        <!-- Hero-Section
          ================================================== -->

        <div class="hero row">
            <div class="hero-right col-sm-6 col-sm-6">
                <h1 class="header-headline bold"> 世界の景色をお手軽に <br></h1>
                <h4 class="header-running-text light"> You can see so easy
                the view of the world. </h4>
               

            <button class="hero-btn" > Enter</button>
                
            </div>
<!--                    <button class="hero-btn" id="popup" onclick="div_show()"> Enter</button>-->
<!--                     <button class="hero-btn" > Enter</button> -->
                
<!--             </div><!--hero-left--> 

            <div class="col-sm-6 col-sm-6 ">
                  <div class="loginpanel">
                  <div class="txt">
                  <input id="user6" type="text" placeholder="E-mail" />
                  <label for="user" class="entypo-mail"></label>
                  </div>
                      <div class="txt">
                        <input id="pwd7" type="password" placeholder="Password" />
                          <label for="pwd" class="entypo-lock"></label>
                      </div>
  
                  <div class="buttons">
                    <input type="button" value="Login" />
                    <span>
                    <a href="javascript:void(0)" class="entypo-user-add" > Register</a>
                    </span>
                  </div>
  
                  <a href="json_map.html" class="submit_button">
                  <input type="button" value="Visitor" class="submit_button">
                  </a>

<div id="forget_pw">
  <p>passwordを忘れた方は<a href="#">こちら</a></p>
  </div>
  
  <div class="hr">
    <div></div>
    <div>OR</div>
    <div></div>
  </div>
  
  <div class="social">
    <a href="javascript:void(0)" class="facebook"></a>
    <a href="javascript:void(0)" class="twitter"></a>
    <a href="javascript:void(0)" class="googleplus"></a>
  </div>
</div>
           
            </div>

           
        
<div class="col-sm-6 col-sm-6">

    <div class="kaiintouroku">
        <font size="3" color="black">
            <u>
            <strong><div align="center"><p>新規会員登録</p></div></strong>
            </u></font>
        <div class="txt">
            <input id="user" type="text" placeholder="NickName" />
            <label for="user" class="entypo-user-add"></label>
        </div>

        <div class="txt">
            <input id="user1" type="text" placeholder="E-mail" />
            <label for="user" class="entypo-mail"></label>
        </div>


        <div class="txt">
            <input id="user2" type="text" placeholder="Check E-mail Address" />
            <label for="user" class="entypo-mail"></label>
        </div>


        <div class="txt">
            <input id="pwd1" type="password" placeholder="Password" />
            <label for="pwd" class="entypo-lock"></label>
        </div>

        <div class="txt">
            <input id="pwd2" type="password" placeholder="Check Password" />
            <label for="pwd" class="entypo-lock"></label>
        </div>

        <div class="txt">
        </div>

        <div class="buttons">
            <!--      <a href="join/index.php"> -->
            <input type="button" class="hero-btn2" value="Confirm Account" />

        </div>

        <!--hero-->

    </div>
    <!--hero-container-->
</div>


<div class="col-sm-6 col-sm-6">
    <div class="kaiintouroku2">
        <font size="3" color="black">
        <u>
        <strong><div align="center"><p>会員登録確認</p></div></strong>
        </u></font>
        <div class="txt">
            <input id="user_confirm" type="text" placeholder="NickName" readonly />
            <label for="user" class="entypo-user-add"></label>
        </div>

        <div class="txt">
            <input id="email_confirm" type="text" placeholder="E-mail" />
            <label for="user" class="entypo-mail"></label>
        </div>

        <div class="txt">
            <input id="pwd_confirm" type="password" placeholder="Password" />
            <label for="pwd" class="entypo-lock"></label>
        </div>

        <div class="buttons">
            <!--      <a href="join/index.php"> -->
            <input type="button" class="hero-btn2" value="Create Account" />
        </div>
    </div>
    </div>           
            <!--hero-background-->

<!-- Features
  ================================================== -->

 <!--features-section-->

<!-- Logos
  ================================================== -->



<!-- White-Section
  ================================================== -->

<!--white-section-text-section--->


<!-- Pricing
  ================================================== -->
<!--pricing-background-->

<!-- Team
  ================================================== -->

 <!--team-section--->

<!-- Email-Section
  ================================================== -->


<!--blue-section-->

<!-- Footer
  ================================================== -->



<!--footer-->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/login.js"></script>
<script src="js/script.js"></script>

</body>

</html>