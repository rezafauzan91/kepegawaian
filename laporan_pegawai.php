<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="eng">
<head>
<script language="JavaScript">

	var txt 		=" Laporan Pegawai Kecamatan Sentolo";
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
<title>Laporan Pegawai</title>

	<link rel="stylesheet" href="css/bootstrap-3.3.5-dist/css/bootstrap.css" type="text/css"/>
	<link rel="stylesheet" href="css/print.css" type="text/css"  />
</head>

<body class="body">
	<div id="wrapper">
		<div class="header-laplap">
		<div class="wrap-headerlap">
			<div class="ruler-postion">
				<h2 class="heading-lap">PEMERINTAH KABUPATEN KULON PROGO <br> KECAMATAN SENTOLO</h2>
				<p class="heading-adress">Jln Jogja Km 20 Salamrejo telp 027456645 Kode Pos 55664 Yogyakarta</p>
			<div class="img-box">		
				<img class="resize-img" src="images/images_login/logo-lap.png">
			</div>
			</div>
			<hr class="linear-grid"></hr>




		<?php
			include "config/koneksi.php";
			include "config/fungsi_indotgl.php";
			include "config/class_paging.php";
			include "config/kode_auto.php";
			include "config/fungsi_combobox.php";
			include "config/fungsi_nip.php";
		$tampil=mysql_query("select p.nama, p.nip, g.nama_golongan, g.nama_pangkat,p.tgl_masuk, kg.tgl_awal,
		j.n_jab,hj.tgl_ajb 
		 from pegawai p join kenaikan_golongan kg on p.nip=kg.nip join gol_pangkat g on kg.id_golongan=g.id_golongan join h_jabatan hj on p.nip=hj.nip join jabatan j on hj.jabatan=j.id_jab where hj.tgl_kjb='0000-00-00' and kg.tgl_akhir='0000-00-00'");
		echo "<h2 class='head'>LAPORAN DATA PEGAWAI</h2>
				<table class='tabel'>
				<thead>
				<tr>
					<td>No</td>
					<td>Nama/NIP</td>
					<td>Gol/Ruang</td>
				    <td>TMT</td>
					<td>Nama Jabatan</td>
					<td>TMT Jabatan</td>
					<td>Masa Kerja</td>
					<td>Action</td>
				</tr>
  				</thead>";
  		$no=1;
  		function jk($var){
			if($var=="P"){
				echo "Perempuan";
			}else {
				echo "Laki-Laki";
			}
 		}
  		while($dt=mysql_fetch_array($tampil)){
  			$date = date("Y-m-d");
  			$diff = abs(strtotime($date) - strtotime($dt['tgl_masuk']));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  	  echo "<tr>
				<td>$no</td>
    			<td>$dt[nama]<br/>$dt[nip]</td>
    			<td>$dt[nama_golongan]<br/>$dt[nama_pangkat]</td>
    			<td>".tgl_indo($dt['tgl_awal'])."</td>
				<td>$dt[n_jab]</td>
				<td>".tgl_indo($dt['tgl_ajb'])."</td>
				<td>$years Thn $months Bln</td>
				<td>[<a href='detail_laporan.php?id=$dt[nip]'>Detail Pegawai</a>]</td>
  			</tr>";
  		$no++;
  		}
	  echo " </table>";
?>
	<div style="text-align:left;padding:20px;">
		<input class="btn btn-primary noPrint" type="button" value="Cetak Halaman" onclick="window.print()"></div>
</div>
</body>
</html>
