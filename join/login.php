<?php
//ログイン機能


// DBに接続
  require('../dbconnect.php');

  // 書き直し処理（check.phpで書き直し、というボタンが押されたとき）
  if (isset($_GET['action']) && $_GET['action'] == 'rewrite') {

    // 書き直すために初期表示する情報を変数に格納
    // $nick_name = $_POST['nick_name'];
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

  }else{

    $login_email = '';
    $login_password = '';
}

// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST) && !empty($_POST)) {


  // 入力チェック

  //ニックネームが空っぽだったら$errorというエラー情報を格納する変数に

  // emailはblankだったというマークを保存しておく
    if ($_POST["login_email"] == '') {

      $error["login_email"] = 'blank';

    }

  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["login_password"] == '') {
      $error["login_password"] = 'blank';
    }else if (strlen($_POST["login_password"]) < 8) {
      $error["login_password"] = 'length';
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
        $check_sql = "SELECT COUNT(*) as `cnt` FROM `whereis_members` WHERE `email`=?";
       var_dump($check_sql);   

        // sql分実行
        $check_data = array($_POST["login_email"]);
        $check_stmt = $dbh->prepare($check_sql);
        $check_stmt->execute($check_data);

        // 件数取得
        $count = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['cnt'] > 0) {
          # 重複エラー
          $error['login_email'] = "duplicated";
        }
      } catch (Exception $e) {
        
      }

// var_dump($error);

  // check.phpに移動
      // header('Location: check.php');

  // これ以下のコードを無駄に処理しないように、このページの処理を終了させる
      exit();

    }else{
      $error['image'] = 'type';
    }

      }

?>






<?php

//クッキー情報が存在してたら（自動ログイン）
// $_POSTにログイン情報を保存します
if (isset($_COOKIE["email"]) && !empty($_COOKIE["email"])){
  $_POST["login_email"] = $_COOKIE["email"];
  $_POST["login_password"] = $_COOKIE["password"];
  $_POST["save"] = "on";

}

//DBに接続
require('../dbconnect.php');

// POST送信されていたら
if (isset($_POST) && !empty($_POST)){
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
    // echo "<pre>";
    var_dump($member);
    var_dump($login_sql);
    // echo "</pre>";
    
    if ($member == false){
      // 認証失敗
      $error["login"] = "failed";
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
      header("Location: ../post.html");
      exit();
    }

  } catch (Exception $e) {
    
  }


}

?>