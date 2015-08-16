<?php session_start();
	include "../../config/koneksi.php";
	include "../../config/fungsi_indotgl.php";
	include "../../config/class_paging.php";
	include "../../config/kode_auto.php";
	include "../../config/fungsi_thumb.php";

$module	=$_GET['module'];
$act	=$_GET['act'];

// aksi hapus
if($module=='pegawai' AND $act=='hapus' ){ 
	mysql_query("delete from pegawai where nip='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}
// aksi input
if($module=='pegawai' AND $act=='input' ){
  	$acak           = rand(000000,999999);
	
	//pegawai
  	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  	// $tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
  	$nama_file_unik = $acak.$nama_file;

  	//golongan
  	$lokasi_file2   = $_FILES['foto_sk_golongan']['tmp_name'];
  	// $tipe_file      = $_FILES['foto_sk_golongan']['type'];
  	$nama_file_gol  = $_FILES['foto_sk_golongan']['name'];
  	$nama_file_unik_gol = $acak.$nama_file_gol;

  	//jabatan
  	$lokasi_file3   = $_FILES['foto_sk_jabatan']['tmp_name'];
  	// $tipe_file      = $_FILES['foto_sk_jabatan']['type'];
  	$nama_file_jab  = $_FILES['foto_sk_jabatan']['name'];
  	$nama_file_unik_jab = $acak.$nama_file_jab;

	if (!empty($lokasi_file) && !empty($lokasi_file2) && !empty($lokasi_file3)) {  
		// $tgl_lahir ="$_POST[tahun]-$_POST[bulan]-$_POST[hari]";
		// $tgl_masuk ="$_POST[tm]-$_POST[bm]-$_POST[hm]";
		// Uploadfoto($nama_file_unik);
	// file di upload ke dlm folder sk golongan
	$vdir_upload1    = "../../sk/sk_golongan/";
    move_uploaded_file($_FILES["foto_sk_golongan"]["tmp_name"],$vdir_upload1 . $nama_file_unik_gol);

	// file di upload ke dlm folder sk jabatan
    $vdir_upload2    = "../../sk/sk_jabatan/";
    move_uploaded_file($_FILES["foto_sk_jabatan"]["tmp_name"],$vdir_upload2 . $nama_file_unik_jab);

	// file di upload ke dlm folder image peg
    $vdir_upload3    = "../../image_peg/";
    move_uploaded_file($_FILES["fupload"]["tmp_name"],$vdir_upload3 . $nama_file_unik);

//deklarasi dari form
	$nip 			=$_POST['nip'];
	$nama 			=$_POST['nama'];
	$tmpt_lahir 	=$_POST['tmpt_lahir'];
	$tgl_lahir  	=$_POST['tgl_lahir'];								 
	$jenis_kelamin  =$_POST['jns_kel'];								
	$alamat 		=$_POST['almt'];								 
	$tgl_masuk 		=$_POST['tgl_msk'];

	$no_sk			=$_POST['no_sk'];
	$tgl_sk 		=$_POST['tgl_sk'];	
	$id_gol 		=$_POST['gol'];							 
	
	$no_sk_jab		=$_POST['no_sk_jab'];
	$tgl_sk_jab		=$_POST['tgl_sk_jab'];	
	$id_jab 		=$_POST['jbtn'];								
	
	// $foto 			=$nama_file_unik;		

	if($_POST['mutasi'] == '') {
		$status = 'Asli';
	} else {
		$status = 'Pindahan';
	}						 
	$sql="insert into pegawai (nip,
								nama,
								tmpt_lahir,
								tgl_lahir,
								jenis_kelamin,
								alamat,
								tgl_masuk,
								id_gol,
								id_jab,
								foto, status)
						values 	('$nip',
								 '$nama',
								 '$tmpt_lahir',
								 '$tgl_lahir',
								 '$jenis_kelamin',
								 '$alamat',
								 '$tgl_masuk',
								 '$id_gol',
								 '$id_jab',
								 '$nama_file_unik',
								 '$status')";

		$sql2   ="insert into user (userid, passid, level_user) values ('$_POST[nip]','$_POST[passlogin]','3')";
		$sqlJab ="insert into h_jabatan (nip,no_sk,tgl_sk, tgl_ajb, jabatan, foto_sk) values ('$_POST[nip]','$no_sk_jab','$tgl_sk_jab','$tgl_masuk','$id_jab','$nama_file_unik_jab')";
		$sqlGol ="insert into kenaikan_golongan (nip,no_sk,tgl_sk, tgl_awal, id_golongan,foto_sk) values ('$_POST[nip]','$no_sk','$tgl_sk','$tgl_masuk','$id_gol','$nama_file_unik_gol')";

		if ($_POST['mutasi'] != '') {
			$sql3="insert into mutasi (nip, tgl_mutasi_masuk) values ('$_POST[nip]','$tgl_masuk')";
			$simpan3=mysql_query($sql3);
		} else if ($_POST['mutasi'] == '') {
			$sql3="insert into mutasi (nip) values ('$_POST[nip]')";
			$simpan3=mysql_query($sql3);
		}
		$simpan=mysql_query($sql);
		$simpan2=mysql_query($sql2);
		$simpanJab=mysql_query($sqlJab);
		$simpanGol=mysql_query($sqlGol);
			
			header('location:../../sukses.php');
	}
}
	elseif($module=='pegawai' AND $act=='edit' ){
			
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
	if (!empty($lokasi_file)){  
		
	$tll="$_POST[tl]-$_POST[btl]-$_POST[ttl]";
	$tm="$_POST[tt]-$_POST[bt]-$_POST[ht]";
	Uploadfoto($nama_file_unik);
	mysql_query("update pegawai set nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										 tgl_masuk='$tm',
										 id_gol='$_POST[golongan]',
										 id_jab='$_POST[jabatan]',
										 foto='$nama_file_unik'
										 where nip='$_POST[nip]'");
	
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
	} else {
	$tll="$_POST[tl]-$_POST[btl]-$_POST[ttl]";
	$tm="$_POST[tt]-$_POST[bt]-$_POST[ht]";
	mysql_query("update pegawai set nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										 tgl_masuk='$tm',
										 id_gol='$_POST[golongan]',
										 id_jab='$_POST[jabatan]'
										 where nip='$_POST[nip]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
	}
}

elseif($module=='pegawai' AND $act=='hapus' ){
	mysql_query("delete from pegawai where nip = '$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='pegawai' AND $act=='rp' ){
	mysql_query("insert into pendidikan set nip='$_POST[nip]', t_pdk='$_POST[tahun]', d_pdk='$_POST[dp]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
}

elseif($module=='pegawai' AND $act=='rpedit' ){
	mysql_query("update pendidikan set t_pdk='$_POST[tahun]', d_pdk='$_POST[dp]' where idp='$_POST[idp]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
}

elseif($module=='pegawai' AND $act=='rpdel' ){
	mysql_query("delete from pendidikan where idp = '$_GET[id]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_GET['nip']);
}


elseif($module=='pegawai' AND $act=='pk' ){
	mysql_query("insert into pengalaman_kerja set nip='$_POST[nip]', nm_pekerjaan='$_POST[np]', d_pekerjaan='$_POST[dp]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
}

elseif($module=='pegawai' AND $act=='pkedit' ){
	mysql_query("update pengalaman_kerja set nm_pekerjaan='$_POST[np]', d_pekerjaan='$_POST[dp]'
	where id_peker='$_POST[idp]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_POST['nip']);
}

elseif($module=='pegawai' AND $act=='pkdel' ){
	mysql_query("delete from pengalaman_kerja where id_peker='$_GET[id]'");
	header('location:../../media.php?module=pegawai&act=detail&id='.$_GET['nip']);
}

elseif($module=='pegawai' AND $act=='pwd' ){
	$cek=mysql_query("select * from user where userid='$_POST[nip]' and passid='$_POST[pl]' ");
	if(mysql_num_rows($cek)==0){
	echo "<script>alert('Gagal ganti password !! pasword lama salah ! ');window.location.href='../../media.php?module=pegawai&act=detail&id=$_POST[nip]';</script>";
	} else {
		mysql_query("update user set passid='$_POST[pb]' where userid='$_POST[nip]'");
		echo "<script>alert('Password sukses diubah !!');window.location.href='../../media.php?module=pegawai&act=detail&id=$_POST[nip]';</script>";
	}
	
}




?>