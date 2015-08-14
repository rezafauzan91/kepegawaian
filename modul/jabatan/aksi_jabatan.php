<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='jabatan' AND $act=='input' ){
	mysql_query("insert into jabatan set id_jab='$_POST[id]', n_jab='$_POST[nama]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='jabatan' AND $act=='edit' ){
	mysql_query("update jabatan set n_jab='$_POST[nama]' where id_jab='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='jabatan' AND $act=='hapus' ){
	mysql_query("delete from jabatan where id_jab='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>