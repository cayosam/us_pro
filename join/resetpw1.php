<?php 
header('Content-type: text/plain; charset= UTF-8');

//変数の設定
$redirect_flag = 0;

//入力フォームの判定

     if ($_POST["username"] == '') {

      $redirect_flag = 1;

}

     if ($_POST["email1"] == '') {

      $redirect_flag = 2;

}

?>




<?php
// session_start();
//DB接続
require('../dbconnect.php');

if(isset($_POST["username"]) && !empty($_POST["email1"] )) {

  $resetpw_sql = "SELECT * FROM `whereis_members` WHERE `nick_name`=? AND `email`=? ";
  
  $resetpw_data = array($_POST["username"],$_POST["email1"]);
  $resetpw_stmt = $dbh->prepare($resetpw_sql);
  $resetpw_stmt->execute($resetpw_data);

  $login_member = $resetpw_stmt->fetch(PDO::FETCH_ASSOC);

var_dump($login_member['nick_name']);
var_dump($login_member['email']);


var_dump($_POST["username"]);
var_dump($_POST["email1"]);
}

if (isset($login_member['nick_name']) == $_POST['username'] && isset($login_member['email']) == $_POST['email1']) {
    $redirect_flag = 7;

}else{
    $redirect_flag = 8;
}


 ?>

<?php if ($redirect_flag > 0) { ?>

  <script type="text/javascript">
    console.log('redirect');
    window.location.href='resetpw.php?error=<?php echo $redirect_flag; ?>';
  </script>
 
<?php }
  exit(); 
?>