<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='kjb' AND $act=='input' ){
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
elseif ($module=='kjb' AND $act=='ubahjb') {
	$lokasi_file    = $_FILES['foto_sk']['tmp_name'];
    $nama_file      = $_FILES['foto_sk']['name'];
    $acak           = rand(000000,999999);
    $nama_file_unik = $acak.$nama_file; 
    $vdir_upload    = "../../sk/sk_jabatan/";
    move_uploaded_file($_FILES["foto_sk"]["tmp_name"],$vdir_upload . $nama_file_unik);

	$date = date("Y-m-d");
	mysql_query("update h_jabatan set tgl_kjb='$date',
										  keterangan='$_POST[ket]'
										  where idh='$_POST[idh]'");
	mysql_query("update pegawai set id_jab='$_POST[jbtn]' where nip='$_POST[user]'");
	mysql_query("insert into h_jabatan (nip,no_sk,tgl_sk,tgl_ajb,jabatan,foto_sk) values ('$_POST[user]','$_POST[sk]','$_POST[tgl_sk]','$_POST[tmt_sk]','$_POST[jbtn]','$nama_file_unik')");
	header('location:../../media.php?module='.$module);
}

?>