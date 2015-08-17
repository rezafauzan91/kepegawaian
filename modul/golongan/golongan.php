<script type="text/javascript">
$(document).ready(function(){
	$("#inputgol").validate({ 
	  	errorPlacement: function (error, element) {
    		error.appendTo(element.parents("tr").find("div.errorplace"));
	  	},
        messages: {
            nama : "Kolom nama golongan harus di isi!",
            pangkat : "Kolom nama pangkat harus di isi!"
        }
      });
    $.validator.addMethod('selectcheck', function (value) {
        return (value != '');
    });
});
</script>
<?php

$aksi="modul/golongan/aksi_golongan.php";

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from gol_pangkat order by id_golongan");
	echo "<h2 class='head'>DATA GOLONGAN PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>
	<div id='box-pelatihan'>
		<input type=button value='Tambah Data' class='btn-btnpelatihan' onclick=\"window.location.href='?module=golongan&act=input';\">
	</div>
		<table class='tabel'>
		<thead>
  			<tr>
    			<th class='style-table'>No</th>
    			<th class='style-table'>Id Golongan</th>
    			<th class='style-table'>Nama Golongan</th>
    			<th class='style-table'>Nama Pangkat</th>
				<th class='style-table'>Control</th>
  			</tr>
  		</thead>";
  		$no=1;
  		while($dt=mysql_fetch_array($tampil)){
  	echo "  <tr>
    			<td width='50'>$no</td>
    			<td>$dt[id_golongan]</td>
    			<td>$dt[nama_golongan]</td>
    			<td>$dt[nama_pangkat]</td>
				<td width='100'><span><a class='a-style' href='?module=golongan&act=edit&id=$dt[id_golongan]'>Edit</a></span><span>
				<a class='a-style' href=\"$aksi?module=golongan&act=hapus&id=$dt[id_golongan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span></td>
  			</tr>";
  		$no++;
  	}
	echo"</table>
	<div class='clearfix-bottom'></div>";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Golongan</h2>
			<p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=golongan&act=input' method='post' id='inputgol'>
	<div class='inner-contabox'>

		<table class='tabelform'>
			<tr>
				<td width='150'>ID GOLONGAN</td>
				<td><input class='form-controltxt readonly' name='id' type='text' value=".kdauto(gol_pangkat,G)." readonly></td>
			</tr>
			<tr>
				<td>NAMA GOLONGAN</td>
				<td>
					<input class='form-controltxt' name='nama' type='text' required>
					<div class='errorplace'></div>
				</td>
			</tr>
			<tr>
				<td>NAMA PANGKAT</td>
				<td>
					<input class='form-controltxt' name='pangkat' type='text' required>
					<div class='errorplace'></div>
				</td>
			</tr>
		</table>
		<div class='position-btngolongan'>
			<input type=submit value=Simpan class='btn btn-primary'>
			<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>

		</div>
	</form>
	</div>
	<div class='clearfix-bottom'></div>";

	break;
	
	case "edit":
	$edit=mysql_query("select * from gol_pangkat where id_golongan='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Entry Data Golongan</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=golongan&act=edit' method='post'>
		<table class='tabelform'>
			<tr>
				<td width='150'>Id Golongan</td>
				<td><input class='form-controltxt readonly' name='id' type='text' value='$data[id_golongan]' readonly></td>
			</tr>
			<tr>
				<td>Nama Golongan</td>
				<td><input class='form-controltxt' name='nama' type='text' value='$data[nama_golongan]'></td>
			</tr>
			<tr>
				<td>Nama Pangkat</td>
				<td><input class='form-controltxt' name='pangkat' type='text' value='$data[nama_pangkat]'></td>
		</table>
		<div class='position-btngolongan'>
			<input type=submit value=Update class='btn btn-primary'>
			<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>
		</div>
	</form>
	<div class='clearfix-bottom'></div>";
	break;
	
	case "hapus":
	
	break;
	
		}	

?>