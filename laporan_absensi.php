<!DOCTYPE html>
<html lang="eng">
<head>
<script language="JavaScript">

	var txt 		=" Laporan data absensi perperiode Kecamatan Sentolo";
	var kecepatan	=250;
	var segarkan	=null;


	function bergerak() { 

		document.title  =txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			segarkan=setTimeout("bergerak()",kecepatan);
	}

	bergerak();

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
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

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");

$bul    = $_POST['bulan'];
$bull   = strtoupper($nama_bln[$bul]);
$tampil = mysql_query("select * from pegawai,jabatan,gol_pangkat 
								where pegawai.id_jab=jabatan.id_jab 
								and pegawai.id_gol=gol_pangkat.id_golongan");
$cekabsen=mysql_query("select * from absensi 
								where Month(tanggal_absen)='$_POST[bulan]'
								and Year(tanggal_absen)='$_POST[tahun]'");
$cek=mysql_num_rows($cekabsen);
	if($cek>0){
		echo "<h2 class='head'>LAPORAN DATA ABSENSI PERIODE $bull $_POST[tahun]</h2>
			<table class='tabel'>
				<thead>
					<tr>
						<td rowspan='2'>No</td>
					    <td rowspan='2'>Nip</td>
						<td rowspan='2'>Nama Pegawai</td>
					    <td rowspan='2'>Golongan</td>
						<td rowspan='2'>Kehadiran</td>
						<td colspan='2'>Tidak Hadir</td>
						<td rowspan='2'>Terlambat</td>
					</tr>
  				  	<tr>
						<td>Izin</td>
					    <td>Sakit</td>
  					</tr>
 				</thead>";
		  			$no=1;
		  			while($dt=mysql_fetch_array($tampil)){

					$absen=mysql_query("select* from absensi 
												where Month(tanggal_absen)='$_POST[bulan]'
												and Year(tanggal_absen)='$_POST[tahun]' 
												and status_masuk='Y' 
												and status_keluar='Y' 
												and nip='$dt[nip]'");
					$jml=mysql_num_rows($absen);
					$telat=mysql_query("select* from absensi 
												where Month(tanggal_absen)='$_POST[bulan]'
												and Year(tanggal_absen)='$_POST[tahun]' 
												and terlambat='Y' 
												and nip='$dt[nip]'");
					$izin=mysql_query("select * from absensi 
												where Month(tanggal_absen)='$_POST[bulan]'
												and Year(tanggal_absen)='$_POST[tahun]' 
												and ket='I' 
												and nip='$dt[nip]'");
					$sakit=mysql_query("select * from absensi 
												where Month(tanggal_absen)='$_POST[bulan]'
												and Year(tanggal_absen)='$_POST[tahun]' 
												and ket='S' and nip='$dt[nip]'");
			
					$tot_telat=mysql_num_rows($telat);
					$tot_izin=mysql_num_rows($izin);
					$tot_sakit=mysql_num_rows($sakit);
			
			  		echo"<tr>
							<td>$no.</td>
							<td>$dt[nip]</td>
							<td>$dt[nama]</td>
							<td>$dt[nama_golongan]</td>
							<td>$jml hari</td>
							<td>$tot_izin hari</td>
							<td>$tot_sakit hari</td>
							<td>$tot_telat kali</td>
			  			</tr>";
			  			$no++;
			  		}
					echo "  
			</table>
			";
?>
	<div style="text-align:left;padding:20px;">
		<input class="btn btn-primary noPrint" type="button" value="Cetak Halaman" onclick="window.print()">
	</div>
<?php 
	} else {
		echo "<h2 class='head'>Data Tidak Ditemukan</h2>";
	}
?>
</div>
</body>
</html>
