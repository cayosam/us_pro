<?php 
header('Content-type: text/plain; charset= UTF-8');

//変数の設定
$redirect_flag = 0;

//入力フォームの判定

     if ($_POST["oldpw"] == '') {

      $redirect_flag = 1;

      }else if(strlen($_POST["oldpw"]) < 4) {

      $redirect_flag = 2;
}

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

?>




<?php
session_start();

//DB接続
require('../dbconnect.php');
var_dump($_SESSION["id"]);

if(isset($_POST["oldpw"]) && !empty($_POST["newpw"] && !empty($_POST["confirmpw"]))) {

  $oldpw_sql = "SELECT * FROM `whereis_members` WHERE `id`=".$_SESSION["id"];
  // $oldpw_data = array($_POST["oldpw"],sha1($_POST["oldpw"]));
  $oldpw_stmt = $dbh->prepare($oldpw_sql);
  $oldpw_stmt->execute();

  $login_member = $oldpw_stmt->fetch(PDO::FETCH_ASSOC);

var_dump($login_member['password']);
var_dump($_POST["oldpw"]);

if ($login_member["password"] == sha1($_POST["oldpw"])) {

     if ($_POST["newpw"] == '') {
      $redirect_flag = 3;
      }else if(strlen($_POST["newpw"]) < 4) {
      $redirect_flag = 4;
}else{
    $ud_pwd_sql = "UPDATE `whereis_members` SET `password`=? WHERE `id`=".$_SESSION["id"];
    $ud_pwd_data = array(sha1($_POST['newpw']));
    $ud_pwd_stmt = $dbh->prepare($ud_pwd_sql);
    $ud_pwd_stmt->execute($ud_pwd_data);

    $redirect_flag = 9;
}

}else{
    $redirect_flag = 8;

}
}


 ?>

<?php if ($redirect_flag > 0) { ?>

  <script type="text/javascript">
    console.log('redirect');
    window.location.href='changepw.php?error=<?php echo $redirect_flag; ?>';
  </script>
 
<?php }
  exit(); 
?>