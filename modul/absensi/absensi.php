<?php

$aksi="modul/absensi/aksi_absensi.php";
date_default_timezone_set("Asia/Jakarta");

function masuk($var){
	if($var=='Y'){
		$status="Sudah";
		return $status;
	}
	else if($var=='N'){
		$status="Belum";
		return $status;
	}
}

function keterangan($var){
	if($var=='I'){
		$status="IZIN";
		return $status;
	}
	else if($var=='S'){
		$status="SAKIT";
		return $status;
	}
	else if($var=='M'){
		$status="HADIR";
		return $status;
	} else {
		$status="-";
		return $status;
	}
}

function kehadiran($var){
	if($var=='I'){
		$status="Tidak Masuk";
		return $status;
	}
	else if($var=='S'){
		$status="Tidak Masuk";
		return $status;
	}
	else if($var=='M'){
		$status="Masuk";
		return $status;
	} else {
		$status="-";
		return $status;
	}
}

if ($_SESSION['leveluser']==3 || $_SESSION['leveluser']==1) {
switch($_GET[act]){

	default:
		$nip 	=$_SESSION['namauser'];
		$tgl 	= date('Y-m-d');
		$per 	=explode('-',$tgl);
		$bln 	=$per[1];
		$thn 	=$per[0];
		$waktu  = date ('H:i:s');
		$tampil =mysql_query("select * from absensi,pegawai where 
							  pegawai.nip=absensi.nip 
						 	  and pegawai.nip='$nip'
						 	  order by absensi.tanggal_absen ASC ");
	
echo "
	  <div class='wrapperboc-absensi'>
		<h2 class='head'> FORM ABSENSI PEGAWAI </h2>
		<p class='headings'>Kecamatan sentolo</p>
			<p class='style-sessionabsensi'>selamat datang $_SESSION[namauser] silahkan mengisi form absensi dibawah ini </p><hr></div></div>
			<form action='$aksi?module=absensi&act=masuk' method='POST' >
			<div class='cent'>
				<div class='absensi'>Tanggal ".tgl_indo($tgl)."</div>
					
					<div clas='box-absensi'>
						<div class='inner-boxabsen'>
							<label class=''>Jam Masuk</label>
							<span class='spacerbox'>	
								<input type=text class='form-controltxt' name=jam value='$waktu' readonly></span>
							<span class='spacerbox'>
								<input type=hidden name=tgl value='$tgl'>";
							
								if($_SESSION['namauser']=='admin') {
									echo "<input type=text class='form-controltxt' name=nip value='' placeholder='Masukkan NIP' required>";
								} else {
									echo "<input type=hidden class='form-controltxt' name=nip value='$_SESSION[namauser]'>";
								}
						echo "</span>
						</div>
					</div>";

						
			echo "<div id='box-btnabsen'>";

					if($_SESSION['namauser']=='admin') {

						echo "<div class=''>
								  <span class='btn-length'><input type=submit value=IZIN  name=izin class='btn btn-primary'></span>
								  <span class='btn-length'><input type=submit value=SAKIT name=sakit class='btn btn-danger'></span>
							  </div>";
					} else {
						echo "<div class=''><input type=submit value=MASUK name=masuk class='btn btn-primary'></div>";
					}

			echo "</div>
			
			</form>
			";

if($_SESSION['namauser']=='admin') {
	echo "";
} else {

	$konv =tgl_indo($tgl);
	$k 	  =explode(' ',$konv);
	$bull =$k[1];
	$thh  =$k[2];
	echo"
	<div id='style-periode'>Periode : $bull $thh</div>
		<table class='tabel'>
			<thead>
			  	<tr>
			    	<th class='style-table'>Tanggal</th>
					<th class='style-table'>Absen Masuk</th>
					<th class='style-table'>Absen Keluar</th>
					<th class='style-table'>Kehadiran</th>
					<th class='style-table'>Keterangan</th>
					<th class='style-table'>Control</th>
			  	</tr>
  			</thead>";
  	$no=1;
  while($dt=mysql_fetch_array($tampil)){
  		echo "  <tr>
				    <td>".tgl_indo($dt['tanggal_absen'])."</td>
					<td>".masuk($dt['status_masuk'])."</td>
					<td>".masuk($dt['status_keluar'])."</td>
				    <td>".kehadiran($dt['ket'])."</td>
				    <td>".keterangan($dt['ket'])."</td>
					<td>
						<span>
							<a href='$aksi?module=absensi&act=keluar&id=$dt[id_absensi]'>Keluar</a>
						</span>
					</td>
  				</tr>";
  	$no++;
  }
echo "  
		</table>
		</div>
		<div class='clearfix-bottom'></div>";
}
	break;
	
	}
}
?>