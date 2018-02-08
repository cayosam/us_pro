<?php

session_start();

// ログインチェックを行う関数
// 関数とは一定の処理を纏めて名前を付けて置いているプログラムの塊
// 何度も同じ「処理を実行したい場合便利
// プログラム言語が事前に用意している関数：組み込み関数
// 自分で定義して作成する関数：自作関数
// login_checkが関数名。呼び出すときに指定するもの
function login_check(){

   if (isset($_SESSION['id'])) {
    // ログインしている状態

  }else{
    // ログインしていない
    // ログイン画面に飛ばす
    header("Location: login.php");
    exit();

  }
}

function delete_tweet(){
  // DBに接続
  require('dbconnect.php');

// 削除したいtweet_id
$delete_tweet_id = $_GET['tweet_id'];


// 論理削除用のUPDATE文
$sql = "UPDATE `tweets` SET `delete_flag` = '1' WHERE `tweets`.`tweet_id` = ".$delete_tweet_id;


// SQL文を実行
     $stmt = $dbh->prepare($sql);
     $stmt->execute();

// 一覧画面に戻る
    header("Location: index.php");
    exit();

}

?>