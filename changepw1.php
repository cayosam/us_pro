<?php 
header('Content-type: text/plain; charset= UTF-8');

require('../dbconnect.php');

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

<?php if ($redirect_flag > 0) { ?>

  <script type="text/javascript">
    console.log('redirect');
    window.location.href='changepw.php?error=<?php echo $redirect_flag; ?>';
  </script>
 
<?php }
  exit(); 
?>