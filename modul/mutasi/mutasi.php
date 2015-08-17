<script type="text/javascript">
$(document).ready(function(){
	$("#inputmutasi").validate({ 
	  	errorPlacement: function (error, element) {
    		error.appendTo(element.parents("tr").find("div.errorplace"));
	  	},
        messages: {
            ket_mutasi : "Kolom keterangan mutasi harus di isi!",
        }
      });
    $.validator.addMethod('selectcheck', function (value) {
        return (value != '');
    });
});
</script>
<?php

$aksi="modul/mutasi/aksi_mutasi.php";

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
				<th class='style-table'>Tgl Keluar</th>
				<th class='style-table'>Status</th>
				<th class='style-table'>Control</th>
		  	</tr>
  		</thead>
  		<tbody>";

	$tampil=mysql_query("select p.nama, p.nip, p.tgl_masuk, p.status, m.tgl_mutasi_masuk, m.tgl_mutasi_keluar from pegawai p join mutasi m on p.nip=m.nip order by p.nama");
  	$no=1;

 	 while($data=mysql_fetch_array($tampil)){
 	 echo " <tr>
   				<td width='40'>$no</td>
    			<td width=''>$data[nip]</td>
    			<td width=''>$data[nama]</td>";
    if($data['status']=="Asli") {
    			echo "<td width='90'>".tgl_indo($data['tgl_masuk'])."</td>";
    } else {
    			echo "<td width='90'>".tgl_indo($data['tgl_mutasi_masuk'])."</td>";
    }

    if($data['tgl_mutasi_keluar']=="0000-00-00") {

    	echo "<td width='90'>-</td>";

    } else {

    	echo "<td width='90'>".tgl_indo($data['tgl_mutasi_keluar'])."</td>";
    }

    echo"		<td>$data[status]</td>
    			<td width='150'>
				<span><a class='a-style' href='?module=mutasi&act=edit&id=$data[nip]'>Mutasi</a></span></td>
  			</tr>";
  	$no++;
  	}
	echo "</tbody>
		  </table>
		  <div class='clearfix-bottom'></div>";
	
	break;
	case "edit":

	$ambil=mysql_query("select * from pegawai, mutasi where pegawai.nip=mutasi.nip and pegawai.nip='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Edit Data Pegawai</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=mutasi&act=edit' method='post' enctype='multipart/form-data' id='inputmutasi'>
		<table class='tabelform tabpad' style='text-align:left;'>
			<tr>
				<td width='150'>Nip</td>
				<td><input type'text' class='form-controltxt readonly' value='$t[nip]' readonly></td>
			</tr>
			<tr>
				<td>Nama Pegawai</td>
				<td><input type'text' class='form-controltxt readonly' value='$t[nama]' readonly></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td><input type'text' class='form-controltxt readonly' value='$t[tmpt_lahir]' readonly></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><input type'text' class='form-controltxt readonly' value=".tgl_indo($t['tgl_lahir'])." readonly></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>";
						if($t['jenis_kelamin']=='L'){ 
							echo "Pria";
						} 
						else if($t['jenis_kelamin']=='P'){ 
							echo "Wanita ";
						} 
		echo "	</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea class='form-controltextarea readonly' readonly>$t[alamat]</textarea></td>
			</tr>
			<tr>
				<td>Tanggal Masuk</td>
				<td>";
				if($t['status']=='Asli') {
						echo tgl_indo($t['tgl_masuk']);
				} else {
						echo tgl_indo($t['tgl_mutasi_masuk']);
				}
		echo "
				</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td>";
					$gol=mysql_query("select * from gol_pangkat");
					while($g=mysql_fetch_array($gol)){
							if($t['id_gol']==$g['id_golongan']){
								echo "$g[nama_golongan]";
							} 
					}
	echo " 			
				</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>";
						$jab=mysql_query("select * from jabatan");
						while($j=mysql_fetch_array($jab)){
					if($t['id_jab']==$j['id_jab']){
						echo "$j[n_jab]";
					} 
					}
	echo "			
				</td>
			</tr>
			<tr>
				<input name='id' type='hidden' value='$_GET[id]'>
				<td>Keterangan Mutasi</td>
				<td>
					<textarea class='form-controltextarea' name='ket_mutasi' required></textarea>
					<div class='errorplace'></div>
				</td>
		</table>
		<div class='position-btnmutasi'>
			<input type=submit value=Simpan class='btn btn-primary'>
			<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>
		</div>
	</form>
	";

	break;
}
?>