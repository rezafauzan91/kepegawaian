<script type="text/javascript">
  $(document).ready(function(){
   	$('.tgl-sk').Zebra_DatePicker({
		  direction: true,
		  pair: $('.tmt-sk')
		});

		$('.tmt-sk').Zebra_DatePicker({
		  direction: 1
		});
  });
</script>
<?php
$aksi="modul/k_golongan/aksi_kg.php";
date_default_timezone_set("Asia/Jakarta");

switch($_GET[act]){
	default:
	// $tanggal= date('Y-m-d');
	$tampil=mysql_query("select * from pegawai,gol_pangkat where pegawai.id_gol=gol_pangkat.id_golongan order by pegawai.nama");
	echo "<div><h2 class='head'>DATA KENAIKAN GOLONGAN</h2></div>
				<p class='headings'>Kecamatan sentolo</p>
	<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>No</th>
			    <th class='style-table'>Nip</th>
			    <th class='style-table'>Nama Pegawai</th>
				<th class='style-table'>Golongan Sekarang</th>
				<th class='style-table'>Control</th>
  			</tr>
  		</thead><tbody>";
  $no=1;

  while($dt=mysql_fetch_array($tampil)){?>
    	<tr>
    		<td><?php echo $no;?></td>
    		<td><?php echo $dt['nip']; ?></td>
    		<td><?php echo $dt['nama']; ?></td>
    		<td><?php echo $dt['nama_golongan'];?></td>
    		<td><a href="?module=kg&act=detail&id=<?php echo $dt['nip'] ?>">Ubah Golongan</a></td>
    	</tr>
 <?php  $no++;
  }
			echo "  
	</tbody>
	</table>
	<div class='clearfix-bottom'></div>";
	
	break;
	case 'detail':
	$tampil=mysql_query("select p.nip, p.nama, g.nama_golongan from pegawai p join gol_pangkat g on p.id_gol=g.id_golongan where p.nip='$_GET[id]'");
	$_tampil=mysql_query("select p.nip, p.nama, g.nama_golongan from pegawai p join gol_pangkat g on p.id_gol=g.id_golongan where p.nip='$_GET[id]'");
	$cr_id =mysql_query("select id_kg from kenaikan_golongan where nip='$_GET[id]' and tgl_akhir='0000-00-00'");
	$cr_tgl =mysql_query("select tgl_awal from kenaikan_golongan where nip='$_GET[id]' and tgl_akhir='0000-00-00'");
	$tampilJb=mysql_query("select kg.tgl_awal, kg.tgl_akhir, g.nama_golongan from kenaikan_golongan kg join gol_pangkat g on kg.id_golongan=g.id_golongan where kg.nip='$_GET[id]' order by kg.id_kg desc");

	$cr_tgl_dt = mysql_fetch_array($cr_tgl);
	$cr_id_dt = mysql_fetch_array($cr_id);
	echo "<h2 class='head'>DATA PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>
		<table class='tabel'>";
	  	while($dt=mysql_fetch_array($tampil)){
	  	echo "  <tr>
	    			<td>NIP</td>
	    			<td>$dt[nip]</td>
	    		</tr>
	    		<tr>
					<td>Nama Pegawai</td>
					<td>$dt[nama]</td>
	    		</tr>";
	  	}
		echo "</table>";
	echo "<h2 class='head'>HISTORY GOLONGAN PEGAWAI</h2>
			<p class='headings'></p>
			<table class='tabel'>
			<tr>
				<td>Golongan</td>
				<td>Tgl Awal</td>
				<td>Tgl Akhir</td>
			</tr>
			";
			while($dtjb=mysql_fetch_array($tampilJb)){
	  	echo "  <tr>
					<td>$dtjb[nama_golongan]</td>
					<td>".tgl_indo($dtjb['tgl_awal'])."</td>
					<td>";
			if($dtjb['tgl_akhir']=="0000-00-00") {
				echo "Sampai Sekarang";
			} else {
				echo tgl_indo($dtjb['tgl_akhir']);
			}

	    echo "</td></tr>";
	  	}
		echo "</table>";

	echo "<h2 class='head'>UBAH GOLONGAN PEGAWAI</h2>
			<p class='headings'></p>";
	  	while($datanya=mysql_fetch_array($_tampil)){

	echo "<form action='$aksi?module=kg&act=ubahkg' method='post'>
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'>Golongan Sekarang</td>
				<td><input class='form-controltxt' name='gol' type='text' value='$datanya[nama_golongan]' readonly>
				<input class='input' name='idg' type='hidden' value='$cr_id_dt[id_kg]'>
				<input class='input' name='user' type='hidden' value='$_GET[id]'>
				<input class='input' name='tglawal' type='hidden' value='$cr_tgl_dt[tgl_awal]'>
				</td>
			</tr>
			<tr>
				<td>Ubah Golongan</td>
				<td>";?>
					<select name="golongan" id="golongan" class="formcontrol-select ">	
						<option value='' selected >Pilih Golongan</option>";
						<?php
							$jabatan=mysql_query("select * from gol_pangkat");
							while($data=mysql_fetch_array($jabatan)){
							echo "<option value='$data[id_golongan]'>$data[nama_golongan]</option>";
							}
						?>
					</select>

				<?php echo "</td>
			</tr>
			<tr>
				<td>Rekomendasi</td>
				<td>
					<input type='radio' name='rekomendasi' value='y'> Ya
					<input type='radio' name='rekomendasi' value='n'> Tidak
				</td>
			</tr>
			<tr>
				<td>No SK</td>
				<td>
					<input class='form-controltxt' name='sk' type='text' value=''>
				</td>
			</tr>
			<tr>
				<td>Tgl SK</td>
				<td>
					<input class='form-controltxt tgl-sk' name='tgl_sk' type='text' value=''>
				</td>
			</tr>
			<tr>
				<td>Tmt SK</td>
				<td>
					<input class='form-controltxt tmt-sk' name='tmt_sk' type='text' value=''>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><textarea class='form-controltextarea' name='ket'></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>";
	}
	break;
}
?>