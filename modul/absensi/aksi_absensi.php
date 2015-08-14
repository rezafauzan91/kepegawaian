<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];

if(isset($_POST['masuk'])){
	$absen=mysql_query("select * from absensi where tanggal_absen='$_POST[tgl]' 
						and nip='$_POST[nip]'");
	if(mysql_num_rows($absen)>0){
		echo "<script>alert('Anda telah melakukan absen!!'); window.location = '../../media.php?module=$module'</script>";
	}else {
	    
		$max=date('08:00:00');
			if($_POST['jam']<$max){
				mysql_query("insert into absensi set nip='$_POST[nip]',
											 tanggal_absen='$_POST[tgl]',
											 jam_masuk='$_POST[jam]',
											 status_masuk='Y',
											 status_keluar='N'");
				header('location:../../media.php?module='.$module);
			}else {
				
				mysql_query("insert into absensi set nip='$_POST[nip]',
											 tanggal_absen='$_POST[tgl]',
											 jam_masuk='$_POST[jam]',
											 status_masuk='Y',
											 status_keluar='N',
											 terlambat='Y'");
				echo "<script>alert('Anda Telat ! Tolong Jangan Ulangi Lagi ^_^ '); window.location = '../../media.php?module=$module'</script>";
			}
		}
	}

 if(isset($_POST['izin'])){
	$absen=mysql_query("select * from absensi where tanggal_absen='$_POST[tgl]' 
						and nip='$_POST[nip]'");
	if(mysql_num_rows($absen)>0){
		echo "<script>alert('Anda telah melakukan absen!!'); window.location = '../../media.php?module=$module'</script>";
	}else { 
		mysql_query("insert into absensi set nip='$_POST[nip]',
											 status_masuk='N',
											 status_keluar='N',
											 ket='I'");
		header('location:../../media.php?module='.$module);
	}
 }
 
 if(isset($_POST['sakit'])){
	$absen=mysql_query("select * from absensi where tanggal_absen='$_POST[tgl]' 
						and nip='$_POST[nip]'");
	if(mysql_num_rows($absen)>0){
		echo "<script>alert('Anda telah melakukan absen!!'); window.location = '../../media.php?module=$module'</script>";
	}else { 
		mysql_query("insert into absensi set nip='$_POST[nip]',
											 status_masuk='N',
											 status_keluar='N',
											 ket='S'");
		header('location:../../media.php?module='.$module);
	}
 }
 


if($module=='absensi' AND $act=='keluar' ){
	date_default_timezone_set("Asia/Jakarta");
		$waktu= date ('H:i:s');
		$absen=mysql_query("select * from absensi where status_keluar='Y' and id_absensi='$_GET[id]'");
		$absen2=mysql_query("select * from absensi where ket='I' and id_absensi='$_GET[id]'");
		$absen3=mysql_query("select * from absensi where ket='S' and id_absensi='$_GET[id]'");

	if(mysql_num_rows($absen)>0){
    	echo "<script>alert('Anda telah melakukan absen keluar'); window.location = '../../media.php?module=$module'</script>";
	}else if(mysql_num_rows($absen2)>0){
    	echo "<script>alert('Anda tidak bisa melakukan absen keluar'); window.location = '../../media.php?module=$module'</script>";
	}else if(mysql_num_rows($absen3)>0){
    	echo "<script>alert('Anda tidak bisa melakukan absen keluar'); window.location = '../../media.php?module=$module'</script>";
	}else {
	mysql_query("update absensi set jam_keluar ='$waktu', status_keluar='Y', ket='M' where id_absensi='$_GET[id]'");
		echo "<script>alert('Absen Keluar OK !'); window.location = '../../media.php?module=$module'</script>";
	}
}

?>