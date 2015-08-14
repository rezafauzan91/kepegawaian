<?php

$aksi="modul/pelatihan/aksi_pelatihan.php";

function nilai($var){
	if($var>=60 and $var<65 ){
		echo "Buruk";
	}
	else if($var>=65 and $var<=75 ){
		echo "Cukup Baik";
	}
	else if($var>75 and $var<=85 ){
		echo "Baik";
	}
	
	else if($var>85 and $var<=95 ){
		echo "Sangat Baik";
	} 
	else {
		echo "N/A";
	}
	
}

if($_SESSION['leveluser']=='1') {

switch($_GET['act']){

	default:
	$tampil=mysql_query("select * from pelatihan order by id_pelatihan");
	echo "<h2 class='head'>DATA PELATIHAN PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>
	<div id='box-pelatihan'>
		<input type=button value='Tambah Data' class='btn-btnpelatihan' onclick=\"window.location.href='?module=pelatihan&act=input';\">
	</div>
		<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>No</th>
			    <th class='style-table'>Nama Pelatihan</th>
				<th class='style-table'>Tgl Pelatihan</th>
				<th class='style-table'>Penyelenggara</th>
				<th class='style-table'>Daftar Peserta</th>
				<th class='style-table'>Control</th>
 			</tr>
  		</thead>";
  	$no=1;
  	while($dt=mysql_fetch_array($tampil)){
  	echo "  <tr>
    			<td>$no</td>
    			<td>$dt[topik_pelatihan]</td>
				<td>".tgl_indo($dt['tgl_pelatihan'])."</td>
				<td>$dt[penyelenggara]</td>
				<td><a class='a-style' href='?module=pelatihan&act=lihat&id=$dt[id_pelatihan]'>Lihat Peserta</a></td>
				<td><span><a class='a-style' href='?module=pelatihan&act=edit&id=$dt[id_pelatihan]'>Edit</a></span><span>
					<a class='a-style' href=\"$aksi?module=pelatihan&act=hapus&id=$dt[id_pelatihan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
				</td>
  			</tr>";
  	$no++;
  	}
echo "  
		</table>
		<div class='clearfix-bottom'></div>";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Pelatihan</h2>
		  <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pelatihan&act=input' method='post' enctype='multipart/form-data'>
	<div id='cntn-entry'>
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'>Tanggal Pelatihan</td>
				<td>";
					$now =  date("Y");
					$saiki = 2000;
					combotgl(1, 31, tp, 0);
					combonamabln(1,12,bp,0);
					combothn(2000, $now, thp, $now);echo "</td>
			</tr>
			<tr>
				<td>Topik Pelatihan</td>
				<td><input class='form-controltxt' name='topik' type='text'></td>
			</tr>
			<tr>
				<td>Penyelenggara</td>
				<td><input class='form-controltxt' name='pl' type='text'></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><textarea class='form-controltextarea' name='ket'></textarea></td>
			</tr>
		</table>
		<div class='list-peserta'>
			<div id='box-inptplatihan'>
					<input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></div>
		</div>
	</form>
	<div class='clearfix-bottom'></div>";

	break;
	case 'lihat':
	$tampil=mysql_query("select * from pelatihan where id_pelatihan=$_GET[id]");

	echo "<h2 class='head'>DATA PELATIHAN PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>
		<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>Nip</th>
			    <th class='style-table'>Nama Pelatihan</th>
				<th class='style-table'>Tgl Pelatihan</th>
				<th class='style-table'>Penyelenggara</th>
 			</tr>
  		</thead>";
	  	$no=1;
	  	while($dt=mysql_fetch_array($tampil)){
	  	echo "  <tr>
	    			<td>$no</td>
	    			<td>$dt[topik_pelatihan]</td>
					<td>".tgl_indo($dt['tgl_pelatihan'])."</td>
					<td>$dt[penyelenggara]</td>
	  			</tr>";
	  	$no++;
	  	}
		echo "  
		</table>";
		echo "<h2 class='head'>DATA PESERTA</h2>";
	$tampilpeserta = mysql_query("select * from peserta_pelatihan, pegawai, 
		pelatihan where peserta_pelatihan.nip=pegawai.nip and peserta_pelatihan.id_pelatihan=pelatihan.id_pelatihan 
		and pelatihan.id_pelatihan='$_GET[id]' order by pegawai.nama");
	echo "<table class='tabel'>
		<thead>
  			<tr>
			    <th class='style-table'>No</th>
			    <th class='style-table'>NIP</th>
			    <th class='style-table'>Nama Peserta</th>
			    <th class='style-table'>Nilai Peserta</th>
 			</tr>
  		</thead>";
  		$no=1;
	  	while($dt=mysql_fetch_array($tampilpeserta)){
	  	echo "  <tr>
	    			<td>$no</td>
	    			<td>$dt[nip]</td>
	    			<td>$dt[nama]</td>
					<td>$dt[nilai]</td>
	  			</tr>";
	  	$no++;
	  	}
	  	echo "  
		</table>
		<div class='clearfix-bottom'></div>";
	break;

	case "edit":
	$ambil=mysql_query("select * from pelatihan where id_pelatihan='$_GET[id]'");
	$ed=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Edit Data Pelatihan</h2>
	      <p class='headings'>Kecamatan sentolo</p>
	<form action='$aksi?module=pelatihan&act=edit' method='post' enctype='multipart/form-data' >
	<input type='hidden' name='id' value='$ed[id_pelatihan]' >
		<table class='tabelform tabpad'>
			<tr>
				<td width='150'>Topik Pelatihan</td>
				<td><input class='form-controltxt' name='topik' type='text' value='$ed[topik_pelatihan]'></td>
			</tr>
			<tr>
				<td>Tanggal Pelatihan</td>
				<td>";
					$tg=explode("-",$ed['tgl_pelatihan']);
					$tpt=$tg[0];
					$tpb=$tg[1];
					$tph=$tg[2];
					$now =  date("Y");
							$saiki = 2000;
					combotgl(1, 31, tp, $tph);
					combonamabln(1,12,bp,$tpb);
					combothn(2000, $now, thp, $tpt);
			echo "
				</td>
			</tr>
			<tr>
				<td>Penyelenggara</td>
				<td><input class='form-controltxt' name='pl' type='text' value='$ed[penyelenggara]'></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><textarea class='form-controltextarea' name='ket'>$ed[keterangan]</textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type=submit value=Simpan class='btn btn-primary'>
					<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()></td>
			</tr>
		</table>
	</form>
	<div class='clearfix-bottom'></div>";

	break;
	
	}

} else if($_SESSION['leveluser']=='3') {

	switch($_GET['act']){

		default:
		$tampil=mysql_query("select * from pelatihan order by id_pelatihan");
		echo "<h2 class='head'>DATA PELATIHAN PEGAWAI</h2>
				<p class='headings'>Kecamatan sentolo</p>
			<table class='tabel'>
			<thead>
	  			<tr>
				    <th class='style-table'>No</th>
				    <th class='style-table'>Nama Pelatihan</th>
					<th class='style-table'>Tgl Pelatihan</th>
					<th class='style-table'>Penyelenggara</th>
					<th class='style-table'>Detail</th>
	 			</tr>
	  		</thead>";
	  	$no=1;
	  	while($dt=mysql_fetch_array($tampil)){
	  	echo "  <tr>
	    			<td>$no</td>
	    			<td>$dt[topik_pelatihan]</td>
					<td>".tgl_indo($dt['tgl_pelatihan'])."</td>
					<td>$dt[penyelenggara]</td>
					<td><a class='a-style' href='?module=pelatihan&act=lihat&id=$dt[id_pelatihan]'>Detail Pelatihan</a></td>
	  			</tr>";
	  	$no++;
	  	}
	echo "  
			</table>
			<div class='clearfix-bottom'></div>";
	
	break;
	case 'lihat':
	$tampil=mysql_query("select * from pelatihan where id_pelatihan='$_GET[id]' order by id_pelatihan");
	$tampil2=mysql_query("select * from peserta_pelatihan where id_pelatihan='$_GET[id]' and nip='$_SESSION[namauser]'");
	$count = mysql_num_rows($tampil2);
	echo "<h2 class='head'>DATA PELATIHAN PEGAWAI</h2>
			<p class='headings'>Kecamatan sentolo</p>

		<table class='tabelform'>";
	  	$no=1;
	  	while($dt=mysql_fetch_array($tampil)){
	  	echo "  <tr>
	    			<td width='200'>Nama Pelatihan</td>
	    			<td><input type=text value='$dt[topik_pelatihan]' class='form-controltxt' readonly></td>
	    		</tr>
	    		<tr>
					<td>Tanggal Pelatihan</td>
					<td><input type=text value='".tgl_indo($dt['tgl_pelatihan'])."' class='form-controltxt' readonly></td>
	    		</tr>
	    		<tr>
					<td>Penyelenggara</td>
					<td><input type=text value='$dt[penyelenggara]' class='form-controltxt' readonly></td>
	    		</tr>
	    		<tr>
					<td>Keterangan</td>
					<td><input type=text value='$dt[keterangan]'class='form-controltxt' readonly></td>
	    		</tr>";	 
	  	$no++;

	  	}
		echo "  
		</table>";
		echo "<div style='margin:20px 0px 0px 210px; font-family:IstokWebRegular;'>";

				if($count > 0) {
						echo "<span style='margin-right:10px;><a class='btn btn-primary' href=\"$aksi?module=pelatihan&act=batal&id=$dt[id_pelatihan]\" onClick=\"return confirm('Apakah Anda membatalkan pelatihan?')\">Batal</a></span>";
				}else {
						echo "<span style='margin-right:10px;'><a class='btn btn-primary' href=\"$aksi?module=pelatihan&act=ikuti&id=$dt[id_pelatihan]\" onClick=\"return confirm('Apakah Anda mengikuti pelatihan?')\">Ikuti</a></span>";
				}
				echo "<input type=button value=Batal class='btn btn-danger' onclick=self.history.back()>";

		echo "</div>";

		echo "<div class='clearfix-bottom'></div>";
	break;
	}
}

?>