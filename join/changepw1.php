<?php 
header('Content-type: text/plain; charset= UTF-8');

//変数の設定
 $redirect_flag = 0;

//入力フォームの判定

     if ($_POST["newpw"] == '') {

      $redirect_flag = 3;

      }else if(strlen($_POST["newpw"]) < 4) {

      $redirect_flag = 4;
}

     if ($_POST["confirmpw"] == '') {

      $redirect_flag = 5;

      }else if(strlen($_POST["confirmpw"]) < 4) {

      $redirect_flag = 6;
}


    if ($_POST["newpw"] != $_POST["confirmpw"]) {

    $redirect_flag = 7;
    }

     if ($_POST["oldpw"] == '') {

      $redirect_flag = 1;

      }else if(strlen($_POST["oldpw"]) < 4) {

      $redirect_flag = 2;
}

 ?>

<?php

 require('../dbconnect.php');

$error = array();

//POST送信されていたら
if (isset($_POST) && !empty($_POST)){
  
//URLの不正チェック
//GET送信されているコードと現在DBに保存されているpasswordが一致しているか確認
//membersテーブルの中から入力されたメールと合致するデータを取得
  $check_sql = "SELECT * FROM `whereis_members` WHERE `email` = ?";

  $check_data = array($_POST["oldpw"]);
  //SQL実行
  $check_stmt = $dbh->prepare($check_sql);
  $check_stmt->execute($check_data);

  //一行取得
  $member = $check_stmt->fetch(PDO::FETCH_ASSOC);

  if ($_POST["oldpw"] == $member["password"]) {
    //チェックOK
//新しいパスワードでリセット
  //文字列を暗号化して、UPDATE
  $update_sql = "UPDATE `whereis_members` SET `password` = ? WHERE `email` = ?";
  $update_data = array(sha1($_POST["newpw"]),$member["password"]);
  //SQL実行
  $update_stmt = $dbh->prepare($update_sql);
  $update_stmt->execute($update_data);

  header("Location:thanksreset.php");
  }else{
    //不正
    $error["url"] = "invalid";
  }



}




// //POST送信されていたら
// if (isset($_POST) && !empty($_POST)){
//   //membersテーブルの中から入力されたメールと合致するデータを取得
//   $sql = "SELECT * FROM `members` WHERE `email` = ?";

//   $data = array($_POST["oldpw"]);
//   //SQL実行
//   $stmt = $dbh->prepare($sql);
//   $stmt->execute($data);

//   //一行取得
//   $member = $stmt->fetch(PDO::FETCH_ASSOC);

//   //パスワードを上書きするための文字列を作成(email+modified)
//   $str_update_pw = $member["email"] + $member["modified"];


//   //文字列を暗号化して、UPDATE
//   $update_sql = "UPDATE `members` SET `password` = ? WHERE `email` = ?";
//   $update_data = array(sha1($str_update_pw),$member["email"]);
//   //SQL実行
//   $update_stmt = $dbh->prepare($update_sql);
//   $update_stmt->execute($update_data);


//   //暗号化した文字列を使用して、URL作成
//   $reset_url = "http://localhost/seed_sns/reset.php?code=".sha1($str_update_pw);

//   //メールの文章作成
//   $mail_body = "パスワードを設定するため、下記リンクを押してください。";
//   $mail_body .= $reset_url;

//   //メールの送信先
//   $email = $member["email"];

//   //タイトル設定
//   $title = "SeedSNSからパスワード忘れのお知らせ";


//   //Thanksページへ移動
//   header("Location: thanksforgotpass.php");

// }

// ?>


<?php if ($redirect_flag > 0) { ?>

<script type="text/javascript">
console.log('redirect');
window.location.href='changepw.php?error=<?php echo $redirect_flag; ?>';
</script>
 
// <?php }
exit(); 
?>