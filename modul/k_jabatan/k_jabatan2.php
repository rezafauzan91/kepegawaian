<?php
$aksi="modul/k_jabatan/aksi_kjb.php";
date_default_timezone_set("Asia/Jakarta");

switch($_GET[act]){
	default:
	$tanggal= date('Y-m-d');
	$tampil=mysql_query("select * from pegawai,jabatan where pegawai.id_jab=jabatan.id_jab");
	echo "<div><h2 class='head'>DATA KENAIKAN JABATAN</h2></div>
				<p class='headings'>Kecamatan sentolo</p>
	<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>Nip</th>
			    <th class='style-table'>Nama Pegawai</th>
				<th class='style-table'>Tanggal Masuk</th>
				<th class='style-table'>Jabatan Sekarang</th>
				<th class='style-table'>Masa Kerja</th>
				<th class='style-table'>Control</th>
  			</tr>
  		</thead>";
  $no=1;

  while($dt=mysql_fetch_array($tampil)){
    $m=mysql_query("select * from k_jabatan where nip='$dt[nip]'");
		if(mysql_num_rows($m)>0){
			$mk =mysql_fetch_array($m);
			$s  =mysql_query("select * from h_jabatan where idkjb='$mk[idkjb]' order by idh DESC");
			$sk =mysql_fetch_array($s);
	 		$tglmasa =$sk['tgl_kjb'];
		}else {
     		$tglmasa=$dt['tgl_masuk'];
    }	 
	
	$query = "SELECT datediff('$tanggal', '$tglmasa') as selisih";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$tahun = floor($data['selisih']/365);
	$bulan = floor(($data['selisih']-($tahun*365))/30);
  			echo "<tr>
				    <td>$dt[nip]</td>
				    <td>$dt[nama]</td>
					<td>".tgl_indo($tglmasa)."</td>
					<td>$dt[n_jab]</td>
					<td>$tahun tahun / $bulan bln</td>
					<td><span><a href='?module=kjb&act=ubah&id=$dt[nip]'>Ubah</a></span></td>
  				</tr>";
  $no++;
  }
			echo "  
	</table>
	<div class='clearfix-bottom'></div>";
	
	break;
	
	case "ubah":
	$tanggal2= date('Y-m-d');
	$tampil2=mysql_query("select * from pegawai,golongan,jabatan where pegawai.id_jab=jabatan.id_jab and pegawai.id_gol=golongan.id_gol");
		echo "<div><h2 class='head'>DATA KENAIKAN JABATAN</h2></div>
			<table class='tabel'>
				<thead>
  					<tr>
					    <td>Nip</td>
					    <td>Nama Pegawai</td>
						<td>Tanggal Masuk</td>
						<td>Golongan</td>
						<td>Jabatan Sekarang</td>
						<td>Masa Kerja</td>
						<td>Control</td>
  					</tr>
  			</thead>";
  $no=1;

  while($dt2 =mysql_fetch_array($tampil2)){
		 $m2 =mysql_query("select * from k_jabatan where nip='$dt2[nip]'");

		if(mysql_num_rows($m2)>0){
			$mk2 =mysql_fetch_array($m2);
			$s2  =mysql_query("select * from h_jabatan where idkjb='$mk2[idkjb]' order by idh DESC");
			$sk2 =mysql_fetch_array($s2);
	 		$tglmasa2 =$sk2['tgl_kjb'];
		}else {
     		$tglmasa2 =$dt2['tgl_masuk'];
    }	 
	$query = "SELECT datediff('$tanggal2', '$tglmasa2') as selisihh";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	$tahun2 = floor($data['selisihh']/365);
	$bulan2 = floor(($data['selisihh']-($tahun2*365))/30);
  			echo "<tr>
				    <td>$dt2[nip]</td>
				    <td>$dt2[nama]</td>
					<td>".tgl_indo($tglmasa2)."</td>
					<td>$dt2[nm_gol]</td>
					<td>$dt2[n_jab]</td>
					<td>$tahun2 tahun / $bulan2 bln</td>
					<td><span><a href='?module=kjb&act=ubah&id=$dt2[nip]'>Ubah</a></span></td>
  				</tr>";
  $no++;
  }
	echo "  
	</table>";

	$tanggal = date('Y-m-d');
	$tampil  = mysql_query("select * from pegawai,jabatan where pegawai.id_jab=jabatan.id_jab and nip='$_GET[id]'");
	$dt 	 = mysql_fetch_array($tampil);
	$m 		 = mysql_query("select * from k_jabatan where nip='$dt[nip]'");

		if(mysql_num_rows($m)>0){
			$mk =mysql_fetch_array($m);
			$s 	=mysql_query("select * from h_jabatan where idkjb='$mk[idkjb]' order by idh DESC");
			$sk =mysql_fetch_array($s);
			$tglmasa =$sk['tgl_kjb'];
		}else {
     		$tglmasa =$dt['tgl_masuk'];
    }	 
	$query 		= "SELECT datediff('$tanggal', '$tglmasa') as selisih";
	$hasil 		= mysql_query($query);
	$data  		= mysql_fetch_array($hasil);
	$tahun 		= floor($data['selisih']/365);
	$ambil_kode =mysql_query("select * from k_jabatan where nip='$dt[nip]'");

		if(mysql_num_rows($ambil_kode)>0){
			$k    =mysql_fetch_array($ambil_kode);
			$kode =$k['idkjb'];
		}else {
			$kode =kdauto('k_jabatan','KJ');
		}
	
	echo "
	<div class=margin>
	<form action='$aksi?module=kjb&act=input' method='post' enctype='multipart/form-data' >
	<table class='tabelform tabpad'>
		<tr>
			<td>Nip</td>
			<td><input name='nip' class='form-controltxt' type='text' value='$dt[nip]' readonly>
				<input name='idkjb' type='hidden' value='$kode' readonly></td>
		</tr>
		<tr>
			<td>Masa Kerja</td>
			<td><input name='tgawl' type='hidden' value='$tglmasa;' readonly>
				<input name='tmt' class='form-controltxt' type='text' value='$tahun Tahun' readonly></td>
		</tr>
		<tr>
			<td>Jabatan Lama</td>
			<td><input class='form-controltxt' name='jbt' type='text' value='$dt[n_jab]' readonly></td>
		</tr>
		<tr>
			<td>Jabatan Baru</td>
			<td><select name='jabatan' class='formcontrol-select'>	
				<option value='' selected >Pilih Jabatan</option>";
					$jab 	 =mysql_query("select * from jabatan");
					while($j =mysql_fetch_array($jab)){
		echo "  <option value='$j[id_jab]'>$j[n_jab]</option>";
					}
		echo " </select></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><textarea name='ket' class='form-controltextarea'></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>";
				//setting kenaikan golongan 4 tahun jika blm 4 tahun maka tidak bisa diedit
				if($tahun>=4){
		echo " 		<input type=submit value=Simpan class='btn btn-primary'>
			   		<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>";
				}else {
		echo "		<div id=''>";
		echo "<h2 style='color: #FF0B0B';>*Maaf !! karyawan ini belum bisa di rekomendasikan, masa kerja masih kurang dari 4 tahun</h2>";
			}
	echo "	</td>
		</tr>
	</table>
	</form>
</div>";

	break;
	
	}
?>