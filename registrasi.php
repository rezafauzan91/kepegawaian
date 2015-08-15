<?php session_start();

	include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/kode_auto.php";
	include "config/fungsi_combobox.php";
	include "config/fungsi_nip.php";
	//get modul
?>
<!DOCTYPE html>
<html lang="eng">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<!-- FUNGSI TITLE BERGERAK -->
<script language="JavaScript">

	var txt 		=" Sistem Informasi Kepegawaian Kecamatan Sentolo";
	var kecepatan	=250;
	var segarkan	=null;


	function bergerak() { 

		document.title  =txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			segarkan=setTimeout("bergerak()",kecepatan);
	}

	bergerak();

</script>
<title></title>
<!--css-->
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
<!--css-->
</head>
<body>
<div id="container-pegawai">
	<div id="box-wrapper">
	<div clas="">
		<img src="image/">

	</div>
		<div id="box-isi">
			<h2 class="style-heading"> FORM REGISTRASI PEGAWAI</h2>
			<p class="style-heading-min">-- kecamatan sentolo --</p>
		</div>	
	</div><hr>
	
	<?php 
	$aksi="modul/pegawai/aksi_pegawai.php";
	echo "<form action='$aksi?module=pegawai&act=input' method='post' enctype='multipart/form-data' class='f-r'>";

	?>
		<div id="box-isireg">
			<table class='tabelform tabpad'>
				<tr>
					<td width="150">Nip</td>
					<td><input name="nip" id="nip" class="form-controltxt" type="text" required=""></td>
				</tr>
				<tr>
					<td>Password Login</td>
					<td><input name="passlogin" id="passlogin" class="form-controltxt" type="password" required=""></td>
				</tr>
				<tr>
					<td>Nama Pegawai</td>
					<td><input name="nama" id="nama" class="form-controltxt" type="text" required=""></td>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td><input name="tmpt_lahir" class="form-controltxt" type="text" required=""></td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td><select name="tgl" id="tgl" class="formcontrol-select" required>
                			<option value="none" selected="selected" class="formcontrol-select">Tgl*</option>
                				<?php
									for ($i=1; $i<=31; $i++) {
									$tg = ($i<10) ? "0$i" : $i;
									$select = ($tg==$tgl)? "selected" : "";
									echo "<option value='$tg' $select>$tg</option>";	
									}
								?>
						</select>
						<select name="bln" id="bln" class="formcontrol-select" required>
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
						<select name="thn" id="thn" class="formcontrol-select" required>
            				<option value="none" selected="selected">Tahun*</option>
								<?php
									$now = date('Y')-18;
									for ($i=1950; $i<=$now; $i++) {
									$tg = ($i<10) ? "0$i" : $i;
									$select = ($tg==$tgl)? "selected" : "";
									echo "<option value='$tg' $select>$tg</option>";	
									}
								?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><input name="jns_kel" id="jns_kel" type="radio" value="L" />Pria 
						<input name="jns_kel" id="jns_kel" type="radio" value="P" />Wanita
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><textarea name="almt" id="almt" cols="35" rows="5" class="form-controltextarea" required></textarea></td>
				</tr>
				<tr>
					<td>Golongan</td>
					<td><select name='gol' id="gol" class="formcontrol-select" required>
						<option value='' selected >Pilih Golongan</option>";
						<?php
							$bagian=mysql_query("select * from gol_pangkat");
							while($data=mysql_fetch_array($bagian)){
				  			echo "<option value='$data[id_golongan]'>$data[nama_golongan]</option>";
							}
						?>
						</select>
				  	</td>
				</tr>
				<tr>
					<td>No SK Golongan</td>
					<td><input name="no_sk" class="form-controltxt" id="nama" type="text" required=""></td>
				</tr>
				<tr>
					<td>Tanggal SK Golongan</td>
					<td><select name="tgl_sk" id="tgl_msk" class="formcontrol-select" required>
            			<option value='none' selected='selected'>Tgl*</option>
            				<?php
								for ($i=1; $i<=31; $i++) {
								$tg = ($i<10) ? "0$i" : $i;
								$select = ($tg==$tgl)? "selected" : "";
								echo "<option value='$tg' $select>$tg</option>";	
								}
							?>
					</select>
					<select name="bln_sk" id="bln_msk" class="formcontrol-select" required>
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
					<select name='thn_sk' id="tgl_msk" class="formcontrol-select" required>
    					<option value='none' selected='selected'>Tahun*</option>";
    					<?php
							$now = date("Y");
							$sekarang = 2000;
							for($i=$sekarang; $i<=$now; $i++) {
							echo "<option value='$i'>$i</option>";	
							}
						?>
			  		</select>
				  	</td>
				</tr>
				<tr>
					<td>Lampiran SK Golongan</td>
					<td><input name="foto_sk_golongan" id="fupload" type='file' required/></td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="margin-bottom:2%; border-bottom: 1px solid #ccc;padding-bottom: 2%;"></div>
					</td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td><select name="jbtn" id="jbtn" class="formcontrol-select" required>	
						<option value='' selected >Pilih Jabatan</option>";
						<?php
							$jabatan=mysql_query("select * from jabatan");
							while($data=mysql_fetch_array($jabatan)){
							echo "<option value='$data[id_jab]'>$data[n_jab]</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>No SK Jabatan</td>
					<td><input name="no_sk_jab" class="form-controltxt" id="nama" type="text" required=""></td>
				</tr>
				<tr>
					<td>Tanggal SK Jabatan</td>
					<td><select name="tgl_sk_jab" id="tgl_msk" class="formcontrol-select" required>
            			<option value='none' selected='selected'>Tgl*</option>
            				<?php
								for ($i=1; $i<=31; $i++) {
								$tg = ($i<10) ? "0$i" : $i;
								$select = ($tg==$tgl)? "selected" : "";
								echo "<option value='$tg' $select>$tg</option>";	
								}
							?>
					</select>
					<select name="bln_sk_jab" id="bln_msk" class="formcontrol-select" required>
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
					<select name='thn_sk_jab' id="tgl_msk" class="formcontrol-select" required>
    					<option value='none' selected='selected'>Tahun*</option>";
    					<?php
							$now = date("Y");
							$sekarang = 2000;
							for($i=$sekarang; $i<=$now; $i++) {
							echo "<option value='$i'>$i</option>";	
							}
						?>
			  		</select>
				  	</td>
				</tr>
				<tr>
					<td>Lampiran SK Jabatan</td>
					<td><input name="foto_sk_jabatan" id="fupload" type='file' required/></td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="margin-bottom:2%; border-bottom: 1px solid #ccc;padding-bottom: 2%;"></div>
					</td>
				</tr>
				<tr>
					<td>Tanggal Masuk</td>
					<td><select name="tgl_msk" id="tgl_msk" class="formcontrol-select" required>
            			<option value='none' selected='selected'>Tgl*</option>
            				<?php
								for ($i=1; $i<=31; $i++) {
								$tg = ($i<10) ? "0$i" : $i;
								$select = ($tg==$tgl)? "selected" : "";
								echo "<option value='$tg' $select>$tg</option>";	
								}
							?>
					</select>
						<select name="bln_msk" id="bln_msk" class="formcontrol-select" required>
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
						<select name='thn_msk' id="tgl_msk" class="formcontrol-select" required>
        					<option value='none' selected='selected'>Tahun*</option>";
        					<?php
								$now = date("Y");
								$sekarang = 2000;
								for($i=$sekarang; $i<=$now; $i++) {
								echo "<option value='$i'>$i</option>";	
								}
							?>
				  		</select>
				  	</td>
				</tr>
				<tr>
					<td>Foto</td>
					<td><input name="fupload" id="fupload" type='file' required/></td>
				</tr>
				<tr>
					<td colspan="3">
						<div id="box-mutasi">
							<p class="style-mutasi">
								<input name="mutasi" id="mutasi" type="checkbox" value="pindahan" /> Keterangan : Jika karyawan pindahan dari instansi lain maka centang kolom ini!,jika tidak abaikan !</p>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Simpan" id="simpan" name="simpan" class="btn btn-primary">
						<input type="submit" value="Batal" class="btn btn-danger" onclick=self.history.back()>
				</tr>
			</table>
			<div style="padding-bottom:50px;"></div>
		</div>
	</form>
	</div>
</body>
</html>

