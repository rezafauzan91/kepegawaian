<?php
$error_login = "Maaf, Username & Password Salah! Atau ID Anda Tidak Dikenal.";
// View Error Message To Browser
?>
<html>
<head>
<title>Login Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css"/>
	<link rel="shortcut icon" href="images/images_admin/favicon.ico"/>
</head>
<body class="erorr">
	<div id="mainerror" style="width:560px;">
		<div id="error_login">
			<img src="images/images_login/img_login_lock.png" width="30" height="31" align="absmiddle" class="img_lock"/>
			<?php 
				echo "$error_login";
			?><br/>
		<center><a href="index.php" class="klikdsini">ULANGI LAGI</a></center>
		</div>
		<div class=\"clear\"></div>
			<div id=\"vertical_effect\">&nbsp;</div>
	</div>
</body>
</html>
