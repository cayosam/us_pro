<?php
// ステップ１ DBに接続する
// 開発環境用
  $dsn = 'mysql:dbname=seed_sns;host=localhost';

// $user　DB接続用ユーザ名
// $password　DB接続用ユーザのPW
  $user = 'root';
  $password='';

  
  // DB接続オブジェクト
  $dbh = new PDO($dsn, $user, $password);

  // 例外処理を使用可能にする方法（エラー文を表示することが出来る）
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// 今から実行するSQL文を文字コードutf8で送る設定（文字化け防止）
  $dbh->query('SET NAMES utf8');

?>