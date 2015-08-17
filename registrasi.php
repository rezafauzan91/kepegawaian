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
<title></title>
<!--css-->
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<link rel="stylesheet" href="css/default.css" type="text/css">
	<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/zebra_datepicker.js"></script>
<!--css-->
<!-- FUNGSI TITLE BERGERAK -->
<script type="text/javascript">

	var txt 		=" Sistem Informasi Kepegawaian Kecamatan Sentolo";
	var kecepatan	=250;
	var segarkan	=null;

	function bergerak() { 
		document.title  =txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			segarkan=setTimeout("bergerak()",kecepatan);
	}
	bergerak();
	
	$(document).ready(function(){
		$('#tgl_lahir, #tgl_sk, #tgl_sk_jab, #tgl_msk').Zebra_DatePicker({
			view: 'years'
		});
		$('#simpan').click(function(){
			var tgl_lahir = $('#tgl_lahir').val();
			var tgl_msk = $('#tgl_msk').val();
			var tgl_sk = $('#tgl_sk').val();
			var tgl_sk_jab = $('#tgl_sk_jab').val();
			if(tgl_lahir == '') {
				$('.errorplace_tgllahir').show();
				$('#tgl_lahir').addClass('error');
			}else{
				$('.errorplace_tgllahir').hide();
				$('#tgl_lahir').removeClass('error');
			}

			if(tgl_msk == '') {
				$('.errorplace_tglmasuk').show();
				$('#tgl_msk').addClass('error');
			}else{
				$('.errorplace_tglmasuk').hide();
				$('#tgl_msk').removeClass('error');
			}

			if(tgl_sk == '') {
				$('.errorplace_tglskgol').show();
				$('#tgl_sk').addClass('error');
			}else{
				$('.errorplace_tglskgol').hide();
				$('#tgl_sk').removeClass('error');
			}

			if(tgl_sk_jab == '') {
				$('.errorplace_tglskjab').show();
				$('#tgl_sk_jab').addClass('error');
			}else{
				$('.errorplace_tglskjab').hide();
				$('#tgl_sk_jab').removeClass('error');
			}
		});
		$("#sign-up").validate({ 
		  errorPlacement: function (error, element) {
    		error.appendTo(element.parents("tr").find("div.errorplace"));
		  },
		  ignore: "input[type='text']:hidden",
		onsubmit: true,
		onkeyup: true,
		onclick: true,
          rules: {
              nip:{
              		required:true,
              		number:true,
              		maxlength:18,
              		minlength:18
              },
          },
          messages: {
          	  nip: {
          	  		required: "Kolom nip wajib di isi!",
          	  		number: "Kolom nip harus angka!",
          	  		maxlength: "Kolom nip max 18 karakter!",
          	  		minlength: "Kolom nip min 18 karakter!",
          	  },
              passlogin: "Kolom password tidak boleh kosong!",
              nama: "Kolom nama lengkap tidak boleh kosong!",
              jns_kel : "Kolom jenis kelamin tidak boleh kosong!",
              tmpt_lahir: "Kolom tempat lahir tidak boleh kosong!",
              almt: "Kolom alamat tidak boleh kosong!",
              no_sk : "Kolom no SK golongan tidak boleh kosong!",
              gol: "Kolom pilih golongan harus dipilih!",
              foto_sk_golongan : "Kolom foto SK golongan harus di isi!",
              no_sk_jab : "Kolom no SK jabatan tidak boleh kosong!",
              jbtn : "Kolom pilih jabatan harus dipilih! ",
              foto_sk_jabatan : "Kolom foto SK jabatan harus di isi!",
              fupload : "Kolom foto identitas diri harus di isi!"
          }
      });
      $.validator.addMethod('selectcheck', function (value) {
        return (value != '');
        });
	});
</script>
</head>
<body>
<div id="container-pegawai">
	<div id="box-wrapper">
	<div class="image-resizator">
		<img src="images/images_login/Lambang Kabupaten Kulon Progo.png" class="imagess">

		<div id="box-isi">
			<h2 class="style-heading"> FORM REGISTRASI PEGAWAI</h2>
			<p class="style-heading-min">-- kecamatan sentolo --</p>
		</div>	
	</div>
	</div><hr>
	
	<?php 
	$aksi="modul/pegawai/aksi_pegawai.php";
	echo "<form action='$aksi?module=pegawai&act=input' id='sign-up' class='sign-up' method='post' enctype='multipart/form-data' class='f-r'>";

	?>
		<div id="box-isireg">
			<table class='tabelform tabpad'>
				<tr>
					<td width="150">Nip</td>
					<td>
						<input name="nip" id="nip" class="form-controltxt" type="text" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Password Login</td>
					<td>
						<input name="passlogin" id="passlogin" class="form-controltxt" type="password" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Nama Pegawai</td>
					<td>
						<input name="nama" id="nama" class="form-controltxt" type="text" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td>
						<input name="tmpt_lahir" class="form-controltxt" type="text" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>
						<input name="tgl_lahir" id="tgl_lahir" class="form-controltxt" type="text">
						<div class="errorplace_tgllahir" style="display:none;">Kolom tgl lahir tidak boleh kosong!</div>
					</td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><input name="jns_kel" id="jns_kel" type="radio" value="L" required />Pria 
						<input name="jns_kel" id="jns_kel" type="radio" value="P" />Wanita
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>
						<textarea name="almt" id="almt" cols="35" rows="5" class="form-controltextarea" required></textarea>
						<div class="errorplace"></div>
					</td>
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
						<div class="errorplace"></div>
				  	</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="margin-bottom:2%; border-bottom: 1px solid #ccc;padding-bottom: 2%;"></div>
					</td>
				</tr>
				<tr>
					<td>No SK Golongan</td>
					<td>
						<input name="no_sk" class="form-controltxt" id="no_sk" type="text" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Tanggal SK Golongan</td>
					<td>
						<input name="tgl_sk" id="tgl_sk" class="form-controltxt" type="text">
						<div class="errorplace_tglskgol" style="display:none;">Tanggal SK golongan tidak boleh kosong!</div>
				  	</td>
				</tr>
				<tr>
					<td>Lampiran SK Golongan</td>
					<td>
						<input name="foto_sk_golongan" id="foto_sk_golongan" type='file' required/>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="alert alert-danger" role="alert">Golongan yang di masukkan adalah golongan saat ini. Jadi harap dimasukkan dgn benar, karena tdk bs dirubah setelah di input</div>
					</td>
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
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>No SK Jabatan</td>
					<td>
						<input name="no_sk_jab" class="form-controltxt" id="no_sk_jab" type="text" required>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td>Tanggal SK Jabatan</td>
					<td>
						<input name="tgl_sk_jab" id="tgl_sk_jab" class="form-controltxt" type="text">
						<div class="errorplace_tglskjab" style="display:none;">Tanggal SK jabatan tidak boleh kosong!</div>
				  	</td>
				</tr>
				<tr>
					<td>Lampiran SK Jabatan</td>
					<td>
						<input name="foto_sk_jabatan" id="foto_sk_jabatan" type='file' required/>
						<div class="errorplace"></div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="alert alert-danger" role="alert">Jabatan yang di masukkan adalah jabatan saat ini. Jadi harap dimasukkan dgn benar, karena tdk bs dirubah setelah di input</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="margin-bottom:2%; border-bottom: 1px solid #ccc;padding-bottom: 2%;"></div>
					</td>
				</tr>
				<tr>
					<td>Tanggal Masuk</td>
					<td>
						<input name="tgl_msk" id="tgl_msk" class="form-controltxt" required type="text">
						<div class="errorplace_tglmasuk" style="display:none;">Tanggal masuk tidak boleh kosong!</div>
				  	</td>
				</tr>
				<tr>
					<td>Foto</td>
					<td>
						<input name="fupload" id="fupload" type='file' required/>
						<div class="errorplace"></div>
					</td>
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
					<td colspan="3"><div class="alert alert-warning" role="alert">Sebelum data di simpan dimohon di cek kembali datanya! Terima kasih</div></td>
				</tr>
				<tr>
					<td>
					</td>
					<td><input type="submit" value="Simpan" id="simpan" name="simpan" class="btn btn-primary simpan">
						<a class="btn btn-danger" href="javascript:;" onclick="self.history.back();">Batal</a>
				</tr>
			</table>
			<div style="padding-bottom:50px;"></div>
		</div>
	</form>
	</div>
</body>
</html>

