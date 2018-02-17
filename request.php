<?php 
header('Content-type: text/plain; charset= UTF-8');

require('dbconnect.php');

//変数の設定
 $redirect_flag = 0;

//email重複確認
  if (isset($_POST["email"]) && !empty($_POST["email"])) {
  
    // $errorが存在していなかったら入力が正常と認識
    if (!isset($error["email"])){
      //emailの重複チェック
      // DBに同じemailの登録があるか確認
      try {

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
        }
      } catch (Exception $e) {
        
      }    

      if((isset($error["email"])) && ($error["email"]=='duplicated')){
         $redirect_flag = 2;

        }else{
          //no error
         // $redirect_flag = -1;
        }
}
}

  if (isset($_POST) && !empty($_POST)) {
  
}


//入力フォームの判定
    if ($_POST["username"] == '') {
     
      $redirect_flag = 3;

    }


     if ($_POST["password"] == '') {

      $redirect_flag = 5;

      }else if(strlen($_POST["password"]) < 8) {

      $redirect_flag = 6;
} 


    if ($_POST["email"] == '') {
     
      $redirect_flag = 4;

    }

    if ($_POST["email"] != $_POST["email2"]) {

    $redirect_flag = 7;
    }

    if ($_POST["password"] != $_POST["password2"]) {

    $redirect_flag = 8;
    }



 ?>

<?php if ($redirect_flag > 0) { ?>

  <script type="text/javascript">
    console.log('redirect');
    window.location.href='index.php?error=<?php echo $redirect_flag; ?>';
  </script>
 
<?php }
  exit(); 
?>