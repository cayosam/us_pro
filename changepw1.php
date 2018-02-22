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
require('dbconnect.php');
var_dump($_SESSION["id"]);

  // if (isset($_POST["id"]) && empty($_POST["nick_name"]) && $_GET["error"] == 1) {
    
  //   header("Location: profile.php?error=1");
  //   exit();
  // }


  $sql = "SELECT * FROM `whereis_members` WHERE `id`=".$_SESSION["id"];
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $login_member = $stmt->fetch(PDO::FETCH_ASSOC);

  // var_dump($login_member['id']);


  if(isset($_POST["oldpw"]) && !empty($_POST["newpw"] && !empty($_POST["confirmpw"]))) {

    $ud_pwd_sql = "UPDATE `whereis_members` SET `password`=? WHERE `id`=".$_SESSION["id"];
    $ud_pwd_data = array($_POST['nick_name'],$_POST['email']);
    $ud_pwd_stmt = $dbh->prepare($ud_pwd_sql);
    $ud_pwd_stmt->execute($ud_pwd_data);

    header("Location: changepwd.php?member_id".$_GET["member_id"]);
    exit();
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