<?php 
// session_start();
header('Content-type: text/plain; charset= UTF-8');

require('dbconnect.php');

//   // 書き直し処理（check.phpで書き直し、というボタンが押されたとき）
//   if (isset($_GET['action']) && $_GET['action'] == 'rewrite') {

//     // 書き直すために初期表示する情報を変数に格納
//     // $nick_name = $_POST['nick_name'];
//     $login_email = $_POST['touroku_email'];
//     $login_password = $_POST['touroku_password'];

//   }else{

//     $login_email = '';
//     $login_password = '';
// }

//変数の設定
 $redirect_flag = 0;
 var_dump($redirect_flag);


//   if (isset($_POST["username"]) && !empty($_POST["username"])) {
  
//   // usernameはblankだったというマークを保存しておく
//     if ($_POST["username"] == '') {

//       $error["username"] = 'blank';
//     }
// var_dump($error["username"]);

// $redirect_flag = 3;

// var_dump($redirect_flag);
// }



// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST["email"]) && !empty($_POST["email"])) {
  
  // emailはblankだったというマークを保存しておく
    if ($_POST["email"] == '') {

      $error["email"] = 'blank';

    }

  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["password"] == '') {
      $error["password"] = 'blank';
    }else if (strlen($_POST["password"]) < 8) {
      $error["password"] = 'length';
    }


    // $errorが存在していなかったら入力が正常と認識
    if (!isset($error["email"])){

      // emailの重複チェック
      // DBに同じemailの登録があるか確認
      try {
        // 検索条件にヒットした件数を取得するSQL文
        // COUNT() SQL文の関数。ヒットした数を取得
        // as 別名 取得したデータに別な名前を付けて扱いやすいようにする
        $check_sql = "SELECT COUNT(*) as `cnt` FROM `whereis_members` WHERE `email`=?";
       // var_dump($check_sql);   

        // sql分実行
        $check_data = array($_POST["email"]);
        $check_stmt = $dbh->prepare($check_sql);
        $check_stmt->execute($check_data);

        // 件数取得
        $count = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['cnt'] > 0) {
          # 重複エラー
          $error["email"] = "duplicated";
          var_dump($error["email"]);
        }
      } catch (Exception $e) {
        
      }    

      if((isset($error["email"])) && ($error["email"]=='duplicated')){
         $redirect_flag = 2;

        }else{
          //no error
         $redirect_flag = 1;
        }

}else{
  //no error
  // $redirect_flag = 0;

}
}

 ?>

<?php if ($redirect_flag = 2) { ?>

  <script type="text/javascript">
    console.log('redirect');
    window.location.href= 'index.php?error=<?php echo $redirect_flag; ?>';
  </script>
 
<?php }
  exit(); 
?>