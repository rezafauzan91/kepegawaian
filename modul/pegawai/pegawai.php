<?php

$aksi="modul/pegawai/aksi_pegawai.php";

switch($_GET[act]){

	default:
	echo "<h2 class='head'>FORM DATA PEGAWAI</h2>
		  <p class='headings'>Kecamatan sentolo</p>";

	echo "<table class='tabel'>
		<thead>
		  	<tr>
		    	<th class='style-table'>No</th>
		    	<th class='style-table'>Nip</th>
		    	<th class='style-table'>Nama</th>
				<th class='style-table'>Tgl Masuk</th>
				<th class='style-table'>Golongan</th>
				<th class='style-table'>Jabatan</th>
				<th class='style-table'>Control</th>
		  	</tr>
  		</thead>
  		<tbody>";
	$tampil=mysql_query("select p.nama, p.nip, p.tgl_masuk, g.nama_golongan, j.n_jab from pegawai p join 
		gol_pangkat g on p.id_gol=g.id_golongan join jabatan j on p.id_jab=j.id_jab order by p.nama");
  	$no=1;
 	 while($data=mysql_fetch_array($tampil)){
 	 echo " <tr>
   				<td width='40'>$no</td>
    			<td width=''>$data[nip]</td>
    			<td width=''>$data[nama]</td>
				<td width='90'>".tgl_indo($data['tgl_masuk'])."</td>
    			<td width=''>$data[nama_golongan]</td>
				<td width=''>$data[n_jab]</td>
				<td width='150'><span><a class='a-style' href='?module=pegawai&act=edit&id=$data[nip]'>Edit</a></span><span>
				<a class='a-style' href=\"$aksi?module=pegawai&act=hapus&id=$data[nip]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
				<span><a class='a-style' href='?module=pegawai&act=detail&id=$data[nip]'>Detail</a></span></td>
  			</tr>";
  	$no++;
  	}
	echo "</tbody>
	</table>
	<div class='clearfix-bottom'></div>";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Pegawai</h2>
	<form action='$aksi?module=pegawai&act=input' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td>Nip</td>
				<td><input name='nip' type='text'></td>
			</tr>
			<tr>
				<td>Nama Pegawai</td>
				<td><input class='form-controltxt' name='nama' type='text'></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td><input class='form-controltxt' name='tls' type='text'></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><select name='hari' class='formcontrol-select'>
                	<option value='none' selected='selected'>Tgl*</option>";
						for($h=1; $h<=31; $h++) { 
			echo"   <option value=",$h,">",$h,"</option>";
						} 
	echo"           </select>
					<select name='bulan'>
		            	<option value='none' selected='selected'>Bulan*</option>
						<option value='1'>Januari</option>
						<option value='2'>Februari</option>
						<option value='3'>Maret</option>
						<option value='4'>April</option>
						<option value='5'>Mei</option>
						<option value='6'>Juni</option>
						<option value='7'>Juli</option>
						<option value='8'>Agustus</option>
						<option value='9'>September</option>
						<option value='10'>Oktober</option>
						<option value='11'>November</option>
						<option value='12'>Desember</option>
					</select>
					<select name='tahun'>
            		<option value='none' selected='selected'>Tahun*</option>";
						$now =  date("Y");
						$saiki = 1965;
						for($l=$saiki; $l<=$now; $l++) {
						echo"<option value=",$l,">",$l,"</option>";
						}	
			echo "  </select>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><input name='jk' type='radio' value='L' />Pria 
					<input name='jk' type='radio' value='P' />Wanita</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea name='almt' ></textarea></td>
			</tr>
			<tr>
				<td>Tanggal Masuk</td>
				<td><select name='hm'>
                	<option value='none' selected='selected'>Tgl*</option>";
						for($h=1; $h<=31; $h++) { 
			echo"   <option value=",$h,">",$h,"</option>";
						} 
		echo"        </select>
					<select name='bm'>
		            	<option value='none' selected='selected'>Bulan*</option>
						<option value='1'>Januari</option>
						<option value='2'>Februari</option>
						<option value='3'>Maret</option>
						<option value='4'>April</option>
						<option value='5'>Mei</option>
						<option value='6'>Juni</option>
						<option value='7'>Juli</option>
						<option value='8'>Agustus</option>
						<option value='9'>September</option>
						<option value='10'>Oktober</option>
						<option value='11'>November</option>
						<option value='12'>Desember</option>
					</select>
					<select name='tm'>
            		<option value='none' selected='selected'>Tahun*</option>";
						$now =  date("Y");
						$saiki = 2000;
						for($l=$saiki; $l<=$now; $l++) {
			echo"   <option value=",$l,">",$l,"</option>";
						}	
			echo "  </select>
				</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td><select name='golongan'>
					<option value='' selected >Pilih Golongan</option>";
						$jab=mysql_query("select * from golongan");
						while($j=mysql_fetch_array($jab)){
		echo "		<option value='$j[id_gol]'>$j[nm_gol]</option>";
						}
	echo " 			</select>
				</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td><select name='jabatan'>	
					<option value='' selected >Pilih Jabatan</option>";
						$jab=mysql_query("select * from jabatan");
						while($j=mysql_fetch_array($jab)){
	echo "          <option value='$j[id_jab]'  >$j[n_jab]</option>";
						}
	echo "          </select>
				</td>
			</tr>
			<tr>
				<td>Pendidikan</td>
				<td>:</td>
				<td><input class='input' name='pdk' type='text'></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td><input name='fupload' type='file' /></td>
			</tr>
			<tr>
				<td>Status Pegawai</td>
				<td>:</td>
				<td><select name='sp'>
					<option value='' selected >Pilih Status</option>
					<option value='tetap' >Tetap</option>
					<option value='kontrak' >Kontrak</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type=submit value=Simpan>
					<input type=button value=Batal onclick=self.history.back()>
				</td>
			</tr>
		</table>
	</form>
	<div class='clearfix-bottom'></div>";
	break;
	
	case "edit":

	$ambil=mysql_query("select * from pegawai where nip='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Edit Data Pegawai</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pegawai&act=edit' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td>Nip</td>
				<td><input name='nip' class='form-controltxt' type='text' value='$t[nip]' readonly></td>
			</tr>
			<tr>
				<td>Nama Pegawai</td>
				<td><input class='form-controltxt' name='nama' type='text' value='$t[nama]'></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td><input class='form-controltxt' name='tls' type='text' value='$t[tmpt_lahir]'></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>"; 
					$tg=explode("-",$t['tgl_lahir']);
					$tl=$tg[0];
					$btl=$tg[1];
					$htl=$tg[2];
					combotgl(1, 31, ttl, $htl);
					combonamabln(1,12,btl,$btl);
					combothn(1965, 2000, tl, $tl);
	echo "		</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>";
				echo "<input name='jk' type='radio' value='L'"; 
						if($t['jenis_kelamin']=='L'){ 
							echo "checked";
						} 
							echo "/>Pria ";
				echo "<input name='jk' type='radio' value='P'"; 
						if($t['jenis_kelamin']=='P'){ 
							echo "checked";
						} 
							echo "/>Wanita ";
	
		echo "	</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea class='form-controltextarea' name='almt' >$t[alamat]</textarea></td>
			</tr>
			<tr>
				<td>Tanggal Masuk</td>
				<td>";
						$ta=explode("-",$t['tgl_masuk']);
						$ttm=$ta[0];
						$btm=$ta[1];
						$htm=$ta[2];
						$now =  date("Y");
						$saiki = 2000;

						$ht="ht";
						$bt="bt";
						$tt="tt";
				combotgl(1, 31, $ht, $htm);
				combonamabln(1,12, $bt,$btm);
				combothn($saiki,$now, $tt,$ttm);
	echo "
				</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td><select name='golongan' class='formcontrol-select '>
					<option value=''>Pilih Golongan</option>";
						$jab=mysql_query("select * from gol_pangkat");
						while($j=mysql_fetch_array($jab)){
					if($t['id_gol']==$j['id_golongan']){
						echo "<option value='$j[id_golongan]' selected>$j[nama_pangkat]</option>";
					} else {
						echo "<option value='$j[id_golongan]'>$j[nama_pangkat]</option>";
						}
					}
	echo " 			</select>
				</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td><select name='jabatan' class='formcontrol-select '>	
					<option value='' >Pilih Jabatan</option>";
						$jab=mysql_query("select * from jabatan");
						while($j=mysql_fetch_array($jab)){
					if($t['id_jab']==$j['id_jab']){
						echo "<option value='$j[id_jab]' selected>$j[n_jab]</option>";
					} else {
						echo "<option value='$j[id_jab]'>$j[n_jab]</option>";
						}
					}
	echo "			</select>
				</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td><img src='image_peg/$t[foto]' /></td>
			</tr>
			<tr>
				<td>Ganti Foto</td>
				<td><input name='fupload' type='file' /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit class='btn btn-primary' value=Simpan>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>";

	break;
	
	case "detail":

	$ambil=mysql_query("select * from pegawai where nip='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Data Pegawai</h2>
	<div class='rp' >
		<div class='foto'>";
			if($t[foto]==""){
				echo "<img src='image_peg/no.jpg' width='200' height='240' />";
			} else {
				echo "<img src='image_peg/$t[foto]' width='200' height='240' />";
			}
echo "  </div>
		<div class='box-detailpegawai'>


		</div>
		<table class='tabelform tabpad'>
			<tr>
				<td>Nip</td>
				<td>$t[nip]</td>
			</tr>
			<tr>
				<td>Nama Pegawai</td>
				<td>$t[nama]</td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>$t[tmpt_lahir]</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>"; echo "".tgl_indo($t['tgl_lahir']).""; echo "</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>";
					if($t['jenis_kelamin']=='L'){
						echo "Pria";
					} else {
						echo "Wanita";
					}	
		echo "  </td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>$t[alamat]</td>
			</tr>
			<tr>
				<td>Tanggal Masuk</td>
				<td>";echo "".tgl_indo($t['tgl_masuk']).""; echo "</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td>";
					$gol=mysql_query("select * from golongan where id_gol='$t[id_gol]'");
					$b=mysql_fetch_array($gol);
					echo "$b[nm_gol]";	
		echo "  </td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>";
					$jab=mysql_query("select * from jabatan where id_jab='$t[id_jab]'");
					$j=mysql_fetch_array($jab);
					echo "$j[n_jab]";
		   echo "</td>
			</tr>
			<tr>
				<td colspan='3'>[ <a href='?module=pegawai&act=edit&id=$t[nip]'> Edit Profil </a>] [ <a href='?module=pegawai&act=pwd&id=$t[nip]'> Ganti Password </a>]</td>
			</tr>
		</table>
	<div style='clear:both'></div>
	<h2 class='head'>Riwayat pendidikan</h2>
		<table class='tabel'>
		<thead>
			<tr>
				<td>Tahun</td>
				<td>Detail Pendidikan</td>
			</tr>
		</thead>";
	$nip=$_SESSION['namauser'];
	$ri=mysql_query("select * from pendidikan where nip='$_GET[id]' order by idp ASC");
		if(mysql_num_rows($ri)==0){
	echo " 	<tr>
				<td colspan='2'>*Tidak Ada Data*</td>
			</tr>";
		} else {
			while($p=mysql_fetch_array($ri)){
	echo "
			<tr>
				<td>$p[t_pdk]</td>
				<td>".nl2br($p['d_pdk'] )."</br>[ <a href='?module=pegawai&act=rpedit&id=$p[idp]'>edit</a> | 
					<a href='$aksi?module=pegawai&act=rpdel&id=$p[idp]&nip=$p[nip]'>hapus</a>]</td>
			</tr>";
			}
		}
	echo "
			<tr>
			<td colspan='2'><a href='?module=pegawai&act=rp&id=$_GET[id]'>Tambah Data</a></td></td>
		</table>
	</div>
	<div class='rp2'>
	<h2 class='head'>PENGALAMAN KERJA</h2>
		<table class='tabel'>	
		<thead>
			<tr>
				<td>Nama Pekerjaan</td>
				<td>Detail Pekerjaan</td>
			</tr>	
		</thead>";
	$nip=$_SESSION['namauser'];
	$ri=mysql_query("select * from pengalaman_kerja where nip='$_GET[id]' order by id_peker ASC");
		if(mysql_num_rows($ri)==0){
	echo "  <tr>
				<td colspan='2'>*Tidak Ada Data*</td>
			</tr>";
		} else {
	while($p=mysql_fetch_array($ri)){
	echo "
			<tr>
				<td>$p[nm_pekerjaan]</td>
				<td>".nl2br($p['d_pekerjaan'])." </br>[ <a href='?module=pegawai&act=pkedit&id=$p[id_peker]'>edit</a> | 
					<a href='$aksi?module=pegawai&act=pkdel&id=$p[id_peker]&nip=$p[nip]'>hapus</a>]</td>
			</tr>";
			}
		}
	echo "
			<tr>
				<td colspan='2'><a href='?module=pegawai&act=pk&id=$_GET[id]'>Tambah Data</a></td></td>
		</table>
	</div>
	<div style='clear:both'></div>";

	break;
	
	case "rp":
	echo "<h2 class='head'>TAMBAH RIWAYAT PENDIDIKAN</h2>
	  	  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pegawai&act=rp' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'></td>
				<td><input name='nip' type='hidden' value='$_GET[id]' readonly></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input class='form-controltxt' name='tahun' type='text' required><span> format: 2000-2006</span></td>
			</tr>
			<tr>
				<td>Detail Pendidikan</td>
				<td><textarea class='form-controltextarea' name='dp' rows='5' required></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal  class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
		<div class='clearfix-bottom'></div>
	</form>";

	break;
	
	case "rpedit":
	$edit=mysql_query("select * from pendidikan where idp='$_GET[id]' ");
	$e=mysql_fetch_array($edit);
	echo "<h2 class='head'>EDIT RIWAYAT PENDIDIKAN</h2>
	<form action='$aksi?module=pegawai&act=rpedit' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'></td>
				<td><input name='nip' type='hidden' value='$e[nip]' readonly>
					<input name='idp' type='hidden' value='$_GET[id]' readonly></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td><input class='form-controltxt' name='tahun' type='text' value='$e[t_pdk]'><span> format: 2000-2006</span></td>
			</tr>
			<tr>
				<td>Detail Pendidikan</td>
				<td><textarea class='form-controltextarea' name='dp' rows='5'>$e[d_pdk]</textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit class='btn btn-primary' value=Simpan>
					<input type=button  class='btn btn-danger' value=Batal onclick=self.history.back()></td>
			</tr>
		</table>
		<div class='clearfix-bottom'></div>
	</form>";

	break;
	
	case "pk":
	echo "<h2 class='head'>TAMBAH DATA PENGALAMAN KERJA</h2>
	  	  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pegawai&act=pk' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'></td>
				<td><input name='nip' class='form-controltxt' type='hidden' value='$_GET[id]' readonly></td>
			</tr>
			<tr>
				<td>Nama Pekerjaan</td>
				<td><input class='form-controltxt' name='np' type='text' required><span> </span></td>
			</tr>
			<tr>
				<td>Detail Pekerjaan</td>
				<td><textarea class='form-controltextarea' name='dp' rows='5' required></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
		<div class='clearfix-bottom'></div>
	</form>";

	break;
	
	case "pkedit":
	$edit=mysql_query("select * from pengalaman_kerja where id_peker='$_GET[id]' ");
	$e=mysql_fetch_array($edit);

	echo "<h2 class='head'>EDIT DATA RIWAYAT PENDIDIKAN</h2>
	  	  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pegawai&act=pkedit' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td></td>
				<td><input name='nip' type='hidden' value='$e[nip]' readonly>
					<input name='idp' type='hidden' value='$_GET[id]' readonly></td>
			</tr>
			<tr>
				<td>Nama Pekerjaan</td>
				<td><input class='form-controltxt' name='np' type='text' value='$e[nm_pekerjaan]'><span> </span></td>
			</tr>
			<tr>
				<td>Detail Pekerjaan</td>
				<td><textarea class='form-controltextarea' name='dp' rows='5'>$e[d_pekerjaan]</textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>";

	break;
	
	case "pwd":
	echo "<h2 class='head'>GANTI PASSWORD</h2>
	  	  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pegawai&act=pwd' method='post' enctype='multipart/form-data' >
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'></td>
				<td><input name='nip' type='hidden' value='$_GET[id]' readonly></td>
			</tr>
			<tr>
				<td>Password Lama</td>
				<td><input class='form-controltxt' name='pl' type='password'><span> </span></td>
			</tr>
			<tr>
				<td>Password Baru</td>
				<td><input class='form-controltxt' name='pb' type='password'><span> </span></td>
			</tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
		<div class='clearfix-bottom'></div>
	</form>";

	break;
		
	}
	
?>