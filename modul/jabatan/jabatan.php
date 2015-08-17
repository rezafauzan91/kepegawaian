<script type="text/javascript">
$(document).ready(function(){
	$("#inputjb").validate({ 
	  	errorPlacement: function (error, element) {
    		error.appendTo(element.parents("tr").find("div.errorplace"));
	  	},
        messages: {
            nama : "Kolom nama jabatan harus di isi!",
        }
      });
    $.validator.addMethod('selectcheck', function (value) {
        return (value != '');
    });
});
</script>
<?php

$aksi="modul/jabatan/aksi_jabatan.php";

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from jabatan order by id_jab DESC");
	echo "<h2 class='head'>DATA JABATAN PEGAWAI</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<div id='box-pelatihan'>
		<input type=button value='Tambah Data' class='btn-btnpelatihan' onclick=\"window.location.href='?module=jabatan&act=input';\">
	</div>
		<table class='tabel'>
		<thead>
  			<tr>
    			<th class='style-table'>No</th>
    			<th class='style-table'>Id Jabatan</th>
    			<th class='style-table'>Jabatan</th>
				<th class='style-table'>Control</th>
  			</tr>
  		</thead>";
  	$no=1;
  	while($dt=mysql_fetch_array($tampil)){
  echo " 	<tr>
    			<td width='50'>$no</td>
    			<td>$dt[id_jab]</td>
    			<td>$dt[n_jab]</td>
				<td width='100'><span><a class='a-style' href='?module=jabatan&act=edit&id=$dt[id_jab]'>Edit</a></span><span>
				<a class='a-style' href=\"$aksi?module=jabatan&act=hapus&id=$dt[id_jab]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span></td>
  			</tr>";
  	$no++;

  	}
echo "  
		</table>
		<div class='clearfix-bottom'></div>";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Jabatan</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=jabatan&act=input' method='post' id='inputjb'>
		<table class='tabelform'>
			<tr>
				<td width='150'>ID JABATAN</td>
				<td><input class='form-controltxt readonly' name='id' type='text' value=".kdauto(jabatan,J)." readonly></td>
			</tr>
			<tr>
				<td>JABATAN</td>
				<td>
					<input class='form-controltxt' name='nama' type='text' required>
					<div class='errorplace'></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal  class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>
	<div class='clearfix-bottom'></div>";

	break;
	
	case "edit":
	$edit=mysql_query("select * from jabatan where id_jab='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2 class='head'>Entry Data Jabatan</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=jabatan&act=edit' method='post'>
		<table class='tabelform'>
			<tr>
				<td width='150'>ID BAGIAN</td>
				<td><input class='form-controltxt readonly' name='id' type='text' readonly value='$data[id_jab]'></td>
			</tr>
			<tr>
				<td>NAMA BAGIAN</td>
				<td><input class='form-controltxt' name='nama' type='text' value='$data[n_jab]'></td>
			</tr>
		</table>
		<div style='margin: 20px 0px 0px 17%;'>
			<input type=submit value=Update class='btn btn-primary'>
			<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>
		</div>
	</form>
	<div class='clearfix-bottom'></div>";

	break;	

	}
	
?>