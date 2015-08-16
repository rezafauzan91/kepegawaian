<script type="text/javascript">
$(document).ready(function(){
   	$('.tgl-sk').Zebra_DatePicker({
	  	direction: true,
		pair: $('.tmt-sk')
	});

	$('.tmt-sk').Zebra_DatePicker({
		direction: 1
	});
	$('.ubahjb').click(function(){
		var tgl_tmt = $('.tmt-sk').val();
		var tgl_sk = $('.tgl-sk').val();

		if(tgl_tmt == '') {
			$('.errorplace_tgltmt').show();
			$('.tmt-sk').addClass('error');
		}else{
			$('.errorplace_tgltmt').hide();
			$('.tmt-sk').removeClass('error');
		}

		if(tgl_sk == '') {
			$('.errorplace_tglsk').show();
			$('.tgl-sk').addClass('error');
		}else{
			$('.errorplace_tglsk').hide();
			$('.tgl-sk').removeClass('error');
		}
	});
	$("#ubahjb").validate({ 
	  	errorPlacement: function (error, element) {
    		error.appendTo(element.parents("tr").find("div.errorplace"));
	  	},
		ignore: "input[type='text']:hidden",
		onsubmit: true,
		onkeyup: true,
		onclick: true,
        messages: {
            ket: "Kolom Keterangan tidak boleh kosong!",
            sk : "Kolom no SK jabatan tidak boleh kosong!",
            jbtn : "Kolom pilih jabatan harus dipilih! ",
            foto_sk : "Kolom foto SK jabatan harus di isi!",
        }
    });
    $.validator.addMethod('selectcheck', function (value) {
	   return (value != '');
    });
});
</script>

<?php
$aksi="modul/k_jabatan/aksi_kjb.php";
date_default_timezone_set("Asia/Jakarta");

switch($_GET[act]){
	default:
	// $tanggal= date('Y-m-d');
	$tampil=mysql_query("select * from pegawai,jabatan where pegawai.id_jab=jabatan.id_jab order by pegawai.nama");
	echo "<div><h2 class='head'>DATA MUTASI JABATAN</h2></div>
				<p class='headings'>Kecamatan sentolo</p>
	<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>No</th>
			    <th class='style-table'>Nip</th>
			    <th class='style-table'>Nama Pegawai</th>
				<th class='style-table'>Jabatan Sekarang</th>
				<th class='style-table'>Control</th>
  			</tr>
  		</thead><tbody>";
  $no=1;

  while($dt=mysql_fetch_array($tampil)){?>
    	<tr>
    		<td><?php echo $no;?></td>
    		<td><?php echo $dt['nip']; ?></td>
    		<td><?php echo $dt['nama']; ?></td>
    		<td><?php echo $dt['n_jab'];?></td>
    		<td><a href="?module=kjb&act=detail&id=<?php echo $dt['nip'] ?>">Ubah Jabatan</a></td>
    	</tr>
 <?php  $no++;
  }
			echo "  
	</tbody>
	</table>
	<div class='clearfix-bottom'></div>";
	
	break;
	case 'detail':

	$tampil=mysql_query("select p.nip, p.nama, j.n_jab from pegawai p join jabatan j on p.id_jab=j.id_jab where p.nip='$_GET[id]'");
	$_tampil=mysql_query("select p.nip, p.nama, j.n_jab from pegawai p join jabatan j on p.id_jab=j.id_jab where p.nip='$_GET[id]'");
	$cr_id =mysql_query("select idh from h_jabatan where nip='$_GET[id]' and tgl_kjb='0000-00-00'");
	$tampilJb=mysql_query("select hj.no_sk, hj.foto_sk, hj.tgl_ajb, hj.tgl_kjb, j.n_jab from h_jabatan hj join jabatan j on 
							hj.jabatan=j.id_jab	where hj.nip='$_GET[id]' order by hj.idh desc");

	$cr_id_dt = mysql_fetch_array($cr_id);
	echo "<h2 class='head'>DATA PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>
		<table class='tabelform'>";
	  	while($dt=mysql_fetch_array($tampil)){
	  	echo "  <tr>
	    			<td width='150'>NIP</td>
	    			<td>$dt[nip]</td>
	    		</tr>
	    		<tr>
					<td>Nama Pegawai</td>
					<td>$dt[nama]</td>
	    		</tr>";
	  	}
		echo "</table>";
	echo "<h2 class='head'>HISTORY MUTASI JABATAN PEGAWAI</h2>
			<p class='headings'></p>
			<table class='tabel'>
			<tr>
				<td>Jabatan</td>
				<td>Tgl Awal Menjabat</td>
				<td>Tgl Akhir Menjabat</td>
				<td>SK Terlampir</td>
			</tr>
			";
			while($dtjb=mysql_fetch_array($tampilJb)){
	  	echo "  <tr>
					<td>$dtjb[n_jab]</td>
					<td>".tgl_indo($dtjb['tgl_ajb'])."</td>
					<td>";
			if($dtjb['tgl_kjb']=="0000-00-00") {
				echo "Masih Menjabat";
			} else {
				echo tgl_indo($dtjb['tgl_kjb']);
			}

	    echo "</td>
	    <td>";
	    if($dtjb['foto_sk'] != '') {
	    	echo "<a href='sk/sk_jabatan/".$dtjb['foto_sk']."' data-lightbox='$dtjb[no_sk]'>Lihat SK</a>";
	    } else {
	    	echo "";
	    }
	    echo "</td></tr>";
	  	}
		echo "</table>";

	echo "<h2 class='head'>UBAH JABATAN PEGAWAI</h2>
			<p class='headings'></p>";
	  	while($datanya=mysql_fetch_array($_tampil)){

	echo "<form action='$aksi?module=kjb&act=ubahjb' id='ubahjb' method='post' enctype='multipart/form-data'>
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'>Jabatan Sekarang</td>
				<td><input class='form-controltxt' name='jab' type='text' value='$datanya[n_jab]' readonly>
				<input class='input' name='idh' type='hidden' value='$cr_id_dt[idh]'>
				<input class='input' name='user' type='hidden' value='$_GET[id]'>
				</td>
			</tr>
			<tr>
				<td>Ubah Jabatan</td>
				<td>";?>
					<select name="jbtn" id="jbtn" class='formcontrol-select' required>
						<option value='' selected >Pilih Jabatan</option>";
						<?php

							$jabatan=mysql_query("select * from jabatan");
							while($data=mysql_fetch_array($jabatan)){
							echo "<option value='$data[id_jab]'>$data[n_jab]</option>";
							}
						?>
					</select>
					<div class="errorplace"></div>
				<?php echo "</td>
			</tr>
			<tr>
				<td>No SK</td>
				<td>
					<input class='form-controltxt' name='sk' type='text' value='' required>
					<div class='errorplace'></div>
				</td>
			</tr>
			<tr>
				<td>Tgl SK</td>
				<td>
					<input class='form-controltxt tgl-sk' name='tgl_sk' type='text' value='' style='cursor: pointer;'>
					<div class='errorplace_tglsk' style='display:none;'>Kolom tgl SK tidak boleh kosong!</div>
				</td>
			</tr>
			<tr>
				<td>Tmt SK</td>
				<td>
					<input class='form-controltxt tmt-sk' name='tmt_sk' type='text' value='' style='cursor: pointer;'>
					<div class='errorplace_tgltmt' style='display:none;'>Kolom tgl TMT SK tidak boleh kosong!</div>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>
					<textarea name='ket' class='form-controltextarea' required></textarea>
					<div class='errorplace'></div>
				</td>
			</tr>
			<tr>
				<td>Lampiran SK</td>
				<td>
					<input type='file' name='foto_sk' class='' required/>
					<div class='errorplace'></div>
				</td>
			</tr>
			<tr>
				<td colspan='2'><div class='alert alert-warning' role='alert'>Sebelum data di simpan dimohon di cek kembali datanya! Terima kasih</div></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary ubahjb'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>";
	}
	break;
}
?>