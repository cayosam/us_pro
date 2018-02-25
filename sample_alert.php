<?php
	var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>sweet_alerm.html</title>
	<!-- sweetalertのjs -->
	<script src="sweetalert.min.js"></script>
	<!-- console.logでデバッグを表示させた時に"$ is not defined"と出た時はjqueryが必要という意味 -->
  <script src="jquery-3.3.1.min.js"></script>
</head>
<body>
	<div>
		<h1 style="color: #66CC00;">Sweet Alert</h1>
	</div>
	<form method="POST" action="">
		<!--  4つの種類があります。 success error warning info -->
		<button class="preview" type="button" onclick="swal(&apos;Awesome!&apos;, &apos;Complete!&apos;, &apos;success&apos;)">
			Success!
		</button>
		<button class="preview" type="button" onclick="swal(&apos;Oops&apos;, &apos;Something went wrong!&apos;, &apos;error&apos;)">
	        Error
	    </button>
	    <button class="preview" type="button" onclick="swal(&apos;Attention!&apos;, &apos;Please kindly check it&apos;, &apos;warning&apos;)">
	        Warning
	    </button>
	    <!-- info -->
    </form>

	<!-- 問題 -->
	<!-- ポイント2つ -->
	<!-- form、inputにidをつける -->
	<!-- 関数でまとめる -->
    <form id="myForm" method="POST" action="">
      <input type="text" name="hayato">
      <input type="submit" value="Submit" id="btn-submit">
	</form>
	<script>
		$(document).on('click', '#btn-submit', function(e) {
         e.preventDefault();
      		popup();
		});

		// 関数で一つにまとめる
		function popup() {

			// optionsの中身を設定 = ボタンを押した時に出るダイアログ
			var options = {
			  title: "ボタンを押した時の処理",
			  icon: "info",
			  buttons: {
			    cancel: "Cancel", // キャンセルボタン
			    ok: true
			  }
			};

			// この関数がコールバック処理をしている
			swal(options)
			  // then() メソッドを使えばクリックした時の値が取れます
			  .then(function(val) {
			  	console.log(val)
			    if (val) {
			      // Okボタンが押された時の処理
			      // この中でコールバック処理をしている
			      swal({
			      	text: "Okボタンが押されました",
			      	icon: "success",
			      });
			 	// submitされた何秒後に自動的に閉じる
	           	setTimeout(
	              function(){
	              	// ()の中はformのidからきている #myform #はidを指定する時に使い、. はclassを指定する時に使う
	             $('#myForm').submit();
	            },2000);

			    } else {
			      // キャンセルボタンを押した時の処理
			      // この中でコールバック処理をしている
			      // valには 'null' が返ってきます
			      swal({
			        text: "キャンセルされました",
			        icon: "warning",
			        buttons: false,
			        timer: 2500 // 2.5秒後に自動的に閉じる
			      });
			    }
			});
		}
	</script>
</body>
</html>