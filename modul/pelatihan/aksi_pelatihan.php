<?php session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";
include "../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if($module=='pegawai' AND $act=='hapus' ){ 
	mysql_query("delete from pegawai where nip='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

if($module=='pelatihan' AND $act=='input' ){
	$tl="$_POST[thp]-$_POST[bp]-$_POST[tp]";
	mysql_query("insert into pelatihan (tgl_pelatihan,topik_pelatihan,penyelenggara,keterangan) values 
		('$tl','$_POST[topik]','$_POST[pl]','$_POST[ket]')");
	header('location:../../media.php?module='.$module);
}

elseif($module=='pelatihan' AND $act=='ikuti' ){
	mysql_query("insert into peserta_pelatihan (id_pelatihan,nip) values ('$_GET[id]','$_SESSION[namauser]')");
	header('location:../../media.php?module='.$module);
}
elseif($module=='pelatihan' AND $act=='batal' ){
	mysql_query("delete from peserta_pelatihan where id_pelatihan = '$_GET[id]' and nip='$_SESSION[namauser]'");
	header('location:../../media.php?module='.$module);
}
elseif($module=='pelatihan' AND $act=='edit' ){
    $tl="$_POST[thp]-$_POST[bp]-$_POST[tp]";
	mysql_query("update pelatihan set 	   tgl_pelatihan='$tl',
										   topik_pelatihan='$_POST[topik]',
										   penyelenggara='$_POST[pl]',
										   keterangan='$_POST[ket]'
										   where id_pelatihan='$_POST[id]'
										   ");
	header('location:../../media.php?module='.$module);
}

elseif($module=='pelatihan' AND $act=='hapus' ){
	mysql_query("delete from pelatihan where id_pelatihan = '$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>