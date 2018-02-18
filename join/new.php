<?php
//新規会員登録

  session_start();

// DBに接続
  require('../dbconnect.php');

  // 会員ボタンが押されたとき
    if (isset($_POST) && !empty($_POST)) {
      // 変数に入力された値を代入して扱いやすいようにする
      $nick_name = $_POST['nick_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      try {
  // DBに会員情報を登録するSQL文を作成
  // now() MYSQLが用意している関数。現在日時を取得できる
        $sql = "INSERT INTO `whereis_members` (`nick_name`, `email`, `password`, `created`, `modified`) VALUES (?,?,?,now(),now()) ";

  // SQL文実行
  // sha1 暗号化を行う関数
        $data = array($nick_name,$email,sha1($password));
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

  // $_SESSIONの情報を削除
  // // unset 指定した変数を削除するという意味。SESSIONじゃなくても使える
  //       unset($_POST["join"]);

  // ログインページへ遷移
       header('Location: ../post.html');
        exit();


      } catch (Exception $e) {
        // tryで囲まれた処理でエラーが発生したときにやりたい処理を記述
        
        echo 'SQL実行エラー:' . $e->getMessage();
        exit();

      }
    }

?>