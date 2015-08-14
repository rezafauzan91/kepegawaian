<!DOCTYPE html>
<html lang="eng">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login User</title>
<link rel="stylesheet" type="text/css" href="css/style_login.css" />
<link rel="shortcut icon" href="images/images_admin/favicon.ico" />
<script type="text/javascript">
	function validasi(form){
		if (form.username.value == ""){
				alert("Anda belum mengisikan Username");
			form.username.focus();
		return (false);
		}
		if (form.password.value == ""){
				alert("Anda belum mengisikan Password");
			form.password.focus();
		return (false);
		}
		return (true);
		}
</script>
</head>
<body OnLoad="document.login.username.focus();">
<div class="header-maincntainer">
	<div class="img-headerbox">
		<img class="resizing-img" src="images/images_login/Lambang Kabupaten Kulon Progo.png">
	</div>
	<div class="header-judulweb">
		<div class="header-text">
			<p class="">SISTEM INFORMASI KEPEGAWAIAN </p>
			<p class="">PEMERINTAH KABUPATEN SENTOLO </p>
			<span class="headertext-adress">Jln jogja km 20 salamrejo kode pos 55664</span>
		</div>
	</div>
</div>
<div class="main-left">
	<div class="box-headerlogin">
		<div class="control-headingwelcome">
			<h2>SELAMAT DATANG</h2>
		</div>
			<article class="deskripsi-sistem">
				Ini adalah pintu masuk menuju sistem informasi kepegawaian, untuk dapat mengakses sistem ini silahkan anda
				melakukan login terlebih dahulu

			</article>
	<div id="main">
	<!-- Header -->
	<div class="position-heading">
		<div id="header">LOGIN USER</div>
	</div>
		<!-- Middle -->
			<div id="middle">
				<form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)">
  					<img src="images/images_login/img_login_user.png" align="absmiddle" class="img_user" />
  						<input type="text" name="username" size="29" id="input" />
  					<br/>
					<img src="images/images_login/img_login_pass.png" align="absmiddle" class="img_pass" />
  						<input type="password" name="password" size="29" id="input" />
  					<br/>
  						<input name="Submit" type="submit" value="LOGIN" id="submit" align="absmiddle" />
				</form>
 	 		* Pegawai yang belum mempunyai user untuk login silahkan registrasi disini 
 	 		<a style="color:#ffcf43" href='registrasi.php'>Registrasi Pegawai</a>, selanjutnya silahkan login menggunakan NIP dan password *
		</div>
		<!-- don't Change ;) -->
		<div class="clear"></div>
		<!-- Footer -->
			<div id="footer"><center>Copyright &copy; sistem informasi kepegawaian kecamatan sentolo.</center></div>
				<!-- vertical_effect -->
				<div id="vertical_effect">&nbsp;</div>

	</div>
	</div>
</div>
</body>
</html>
