<?php session_start();
	  error_reporting(0);
	  include "timeout.php";
?>
<!DOCTYPE html>
<html lang="eng">
<head>

<!-- FUNGSI TITLE BERGERAK -->
<script language="JavaScript">

	var txt 		=" Sistem Informasi Kepegawaian Kecamatan Sentolo";
	var kecepatan	=250;
	var segarkan	=null;


	function bergerak() { 

		document.title  =txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			segarkan=setTimeout("bergerak()",kecepatan);
	}

	bergerak();

</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
	<link rel="stylesheet" href="css/style.css" type="text/css"  />
	<link rel="stylesheet" href="css/default.css" type="text/css">
	<link rel="stylesheet" href="css/lightbox.css" type="text/css">
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/zebra_datepicker.js"></script>
	<script type="text/javascript">
      $(document).ready(function(){
			   $('ul.nav').superfish();
		  });
  	</script>
</head>


<body>
<div class="outer-headerbox">
<div id="container">
	<div id="header">
			<span class="judul"></span><br />
			<span class="judul2"></span></br>
</div>
		<div id="menu">
			<ul class="nav">
				<li><a class="border link linkback" href="?module=home">Home</a></li>
	<?php if ($_SESSION['leveluser']=='3' ){ ?>

				<li><a class="border link linkback" href="?module=pegawai&act=detail&id=<?php echo "$_SESSION[namauser]";?>">Data Pegawai</a></li>
				<li><a class="border link linkback" href="?module=absensi">Absensi</a></li>
				<li><a class="border link linkback" href="?module=pelatihan">Pelatihan</a></li>
	<?php } ?>	
	<?php if ($_SESSION['leveluser']=='1'){ ?>

    			<li><a>Master</a>
		        	<ul>
		    			<li><a class="border link linkback" href="?module=pegawai">Master Pegawai</a>
			            <li><a href="?module=golongan" class="li">Master Golongan</a></li>
			            <li><a href="?module=jabatan" class="li">Master Jabatan</a></li>
		            </ul>
            	</li>

            	
            	<li><a>Proses Pengolahan Data</a>
            		<ul>
						<li><a class="border link linkback" href="?module=absensi">Absensi</a></li>
		        		<li><a class="border link linkback" href="?module=kjb">Mutasi Jabatan</a></li>
		        		<li><a class="border link linkback" href="?module=kg">Kenaikan Golongan</a></li>
		        		<li><a class="border link linkback" href="?module=mutasi">Mutasi</a></li>
		        		<li><a class="border link linkback" href="?module=pelatihan">Data Pelatihan</a></li>
		            </ul>
		        </li>
		        
	<?php } ?>
	<?php if($_SESSION['leveluser']!='3'){ ?>
	
				<li><a class="border link linkback" href="#">Laporan</a>
		        	<ul>
						<li><a href="laporan_pegawai.php" class="li" target="_blank">Laporan Data Pegawai</a></li>
		           	 	<li><a href="?module=lap_absensi" class="li">Laporan Data Absensi</a></li>
		            	<!-- <li><a href="laporan_pelatihan.php" target="_blank" class="li">Laporan Data pelatihan</a></li> -->
						<li><a href="laporan_kg.php" target="_blank" class="li">Laporan Kenaikan Golongan</a></li>
		            </ul>
        		</li>
	<?php } ?>
				<li><a href="logout.php"> Logout</a></li>
        		<li class="clear"></li>
    		</ul>
	</div>
	<div id="content">
		<div class="iner-container">
			<div class="inner-form">

			<?php include "data.php"; ?>

			</div>
		</div>
	</div>
	<div id="footer">Copyright &copy; sistem informasi kepegawaian kecamatan sentolo.
		<div class="">
			<article>
				Dikelola oleh Kecamatan Sentolo
				email : sentolo@kulonprogokab.go.id
			</article>
		</div>
		<div class="right-footer">
			<ul class="menus-ul">
				<li class="menus-li"><a class="menus-a" href="">Tentang Kami</a></li>
				<li class="menus-li"><a class="menus-a" href="">Hubungi Kami</a></li>
				<li class="menus-li"><a class="menus-a" href="?module=home">Home</a></li>
		</div>
	</div>
</div>
<script src="js/lightbox.js" type="text/javascript"></script>

</body>
</html>

