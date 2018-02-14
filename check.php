<?php
//新規会員登録E-mail重複確認

// DBに接続
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

// POST送信されたとき
// $_POSTという変数が存在している、かつ、$_POSTという変数の中身が空でないとき
// empty・・・中身が空を判定。0,"",null,falseというものをすべて空と認識する。
  if (isset($_POST) && !empty($_POST)) {
var_dump($_POST["touroku_email"]);

  // 入力チェック

  //ニックネームが空っぽだったら$errorというエラー情報を格納する変数に

  // emailはblankだったというマークを保存しておく
    if ($_POST["touroku_email"] == '') {

      $error["touroku_email"] = 'blank';

    }

  // PWはblankだったというマークを保存しておく
  // stren文字の長さ（文字数）を数字で返してくれる関数
    if ($_POST["touroku_email"] == '') {
      $error["touroku_email"] = 'blank';
    }else if (strlen($_POST["touroku_email"]) < 8) {
      $error["touroku_email"] = 'length';
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
       // var_dump($check_sql);   

        // sql分実行
        $check_data = array($_POST["touroku_email"]);
        $check_stmt = $dbh->prepare($check_sql);
        $check_stmt->execute($check_data);

        // 件数取得
        $count = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['cnt'] > 0) {
          # 重複エラー
          $error['touroku_email'] = "duplicated";
        }
      } catch (Exception $e) {
        
      }

  //移動
      // header('Location: post.html');

  // これ以下のコードを無駄に処理しないように、このページの処理を終了させる
      exit();

    }else{
      $error['image'] = 'type';
    }

      }

?>
