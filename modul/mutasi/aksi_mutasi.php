<?php session_start();
	include "../../config/koneksi.php";
	include "../../config/fungsi_indotgl.php";
	include "../../config/class_paging.php";
	include "../../config/kode_auto.php";
	include "../../config/fungsi_thumb.php";

$module	=$_GET['module'];
$act	=$_GET['act'];

// aksi hapus
if($module=='mutasi' AND $act=='edit' ){ 
	$tgl = date("Y-m-d");
	mysql_query("update pegawai set status='Mutasi' where nip='$_POST[id]'");
	mysql_query("update user set status='1' where userid='$_POST[id]'");
	mysql_query("update mutasi set tgl_mutasi_keluar='$tgl', keterangan='$_POST[ket_mutasi]' where nip='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}
?>