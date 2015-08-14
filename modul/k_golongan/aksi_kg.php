<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='kg' AND $act=='input' ){
	$tm=explode(" ",$_POST['tmt']);
	$tm1=$tm[0];
	$ambil_kode=mysql_query("select * from k_jabatan where nip='$_POST[nip]'");
	if(mysql_num_rows($ambil_kode)>0){ 
	mysql_query("update k_jabatan set nip='$_POST[nip]',
										  masa_kerja='$tm1',
										  keterangan='$_POST[ket]'
										  where idkjb='$_POST[idkjb]',");
	$jbb=mysql_query("select * from jabatan where id_jab='$_POST[jabatan]'");
	$jab=mysql_fetch_array($jbb);
	mysql_query("insert into h_jabatan set idkjb='$_POST[idkjb]', 
										jab_old='$_POST[jbt]' , 
										tgl_ajb='$_POST[tgawl]',
										jabatan_baru='$jab[n_jab]',
										tgl_kjb=now()");
										
	mysql_query("update pegawai set id_jab='$_POST[jabatan]' where nip='$_POST[nip]'");
	header('location:../../media.php?module='.$module);
	
	} else {
	mysql_query("insert into k_jabatan set idkjb='$_POST[idkjb]',
										 nip='$_POST[nip]',
										 masa_kerja='$tm1',
										 keterangan='$_POST[ket]'");
	$jbb=mysql_query("select * from jabatan where id_jab='$_POST[jabatan]'");
	$jab=mysql_fetch_array($jbb);
	mysql_query("insert into h_jabatan set idkjb='$_POST[idkjb]', 
										jab_old='$_POST[jbt]' , 
										tgl_ajb='$_POST[tgawl]',
										jabatan_baru='$jab[n_jab]',
										tgl_kjb=now()");
										
	mysql_query("update pegawai set id_jab='$_POST[jabatan]' where nip='$_POST[nip]'");
	header('location:../../media.php?module='.$module);
	}
}
elseif ($module=='kg' AND $act=='ubahkg') {
	$date = date("Y-m-d");
	$tgl_awal = $_POST['tglawal'];
	$rekomendasi = $_POST['rekomendasi'];

	$diff = abs(strtotime($date) - strtotime($tgl_awal));
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	// echo $date."<br/>";
	// echo $tgl_awal."<br/>";
	// echo $years."<br/>";
	// echo $rekomendasi;
	if($rekomendasi == 'y') {
		mysql_query("update kenaikan_golongan set tgl_akhir='$date',
											  keterangan='$_POST[ket]'
											  where id_kg='$_POST[idg]'");
		mysql_query("update pegawai set id_gol='$_POST[golongan]' where nip='$_POST[user]'");
		mysql_query("insert into kenaikan_golongan (nip,no_sk,tgl_sk,tgl_awal,id_golongan) values ('$_POST[user]','$_POST[sk]','$_POST[tgl_sk]','$_POST[tmt_sk]','$_POST[golongan]')");
		header('location:../../media.php?module='.$module);
	} elseif ($rekomendasi == 'n' && $years <= 4) {
		echo "<script>alert('Anda Belum Bisa Naik Golongan!')</script>";
        echo "<script>history.go(-1)</script>";
	} elseif ($rekomendasi == 'n' && $years >= 4) {
		mysql_query("update kenaikan_golongan set tgl_akhir='$date',
											  keterangan='$_POST[ket]'
											  where id_kg='$_POST[idg]'");
		mysql_query("update pegawai set id_gol='$_POST[golongan]' where nip='$_POST[user]'");
		mysql_query("insert into kenaikan_golongan (nip,no_sk,tgl_sk, tgl_awal,id_golongan) values ('$_POST[user]','$_POST[sk]','$_POST[tgl_sk]','$_POST[tmt_sk]','$_POST[golongan]')");
		header('location:../../media.php?module='.$module);
	}
}

?>