<?php
// Warning Error To Login Admin Page
$sukses = "Terima Kasih. Silahkan Login Menggunakan NIP dan Password";
?>
<html>
<head>
<title>Login Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css"/>
	<link rel="shortcut icon" href="images/images_admin/favicon.ico"/>
</head>
<body class="erorr">
	<div id="main succes" style="width:560px;">
		<div id="error_login">
		<!-- 	<img src="images/images_login/bg_login_error.gif" width="30" height="31" align="absmiddle" class="img_lock"/>  -->
			<img src="images/images_login/img_login_lock.png" width="30" height="31" align="absmiddle" class="img_lock"/> 
				<?php 
					echo "$sukses";
				?><br/>
			<center><a href="index.php" class="klikdsini">Login Sistem</a></center>
		</div>
		<div class="clear"></div>
			<div id="vertical_effect">&nbsp;</div>
	</div>
</body>
</html>

