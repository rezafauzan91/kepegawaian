<?php
 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='golongan' AND $act=='input' ){
	mysql_query("insert into gol_pangkat (id_golongan, nama_golongan, nama_pangkat) values ('$_POST[id]','$_POST[nama]','$_POST[pangkat]')");
	header('location:../../media.php?module='.$module);
}

elseif($module=='golongan' AND $act=='edit' ){
	mysql_query("update gol_pangkat set nama_golongan='$_POST[nama]', nama_pangkat='$_POST[pangkat]' where id_golongan='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='golongan' AND $act=='hapus' ){
	mysql_query("delete from gol_pangkat where id_golongan='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>