<?php
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="eng">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN DATA PEGAWAI</title>
	<link rel="stylesheet" href="css/print.css" type="text/css"  />
</head>
	<style>
		@media print {
		input.noPrint { 
			display: none; 
		}
	}
	</style>
<body class="body">
	<div id="wrapper2">
		<?php
			include "config/koneksi.php";

			include "config/fungsi_indotgl.php";
			include "config/class_paging.php";
			include "config/kode_auto.php";
			include "config/fungsi_combobox.php";
			include "config/fungsi_nip.php";

		$ambil=mysql_query("select * from pegawai where nip='$_GET[id]'");
		$data=mysql_fetch_array($ambil);
	?>
<h2 class='head'>Data Pegawai</h2>
	<div class='foto'>
		<?php
			if($data[foto]==""){
				echo "<img src='image_peg/no.jpg' width='200' height='240' />";
			}else{
				echo "<img src='image_peg/$data[foto]' width='200' height='240' />";
			}
		?>
	</div>
		<table class='tabelform tabpad'>
			<tr>
				<td>Nip</td>
				<td>:</td>
				<td><?php echo $data['nip'];?></td>
			</tr>
			<tr>
				<td>Nama Pegawai</td>
				<td>:</td>
				<td><?php echo $data['nama'];?></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td><?php echo $data['tmpt_lahir'];?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><?php echo $data['tgl_lahir'];?></td>	
	 		</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<?php
						if($data['jenis_kelamin']=='L'){
							echo "Pria";
						}else {
							echo "Wanita";
						}	
					?>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?php echo $data['alamat'];?></td>
			</tr>
			<tr>
	  			<td>Tanggal Masuk</td>
				<td>:</td>
				<td><?php echo $data['tgl_masuk'];?></td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td>:</td>
				<td>
					<?php
						$gol=mysql_query("select * from gol_pangkat where id_golongan='$data[id_gol]'");
						$bag=mysql_fetch_array($gol);
							echo $bag['nama_pangkat'];	
					?>
				</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>
					<?php
						$jab=mysql_query("select * from jabatan where id_jab='$data[id_jab]'");
						$jbtn=mysql_fetch_array($jab);
							echo $jbtn['n_jab'];
					?>
				</td>
			</tr>
		</table>
	<div class='rp' >
		<div style='clear:both'></div>
			<h2 class='head'>Riwayat pendidikan</h2>
		<table class='tabel'>
			<thead>
			<tr>
				<td>Tahun</td>
				<td>Detail Pendidikan</td>
			</tr>
			</thead>
			<?php
				$nip=$_SESSION['namauser'];
				$ri=mysql_query("select * from pendidikan where nip='$_GET[id]' order by idp ASC");
					if(mysql_num_rows($ri)==0){
						echo "<tr><td colspan='2'>*Tidak Ada Data*</td></tr>";
					}else {

						while($p=mysql_fetch_array($ri)){
						echo "
							<tr>
								<td>$p[t_pdk]</td>
								<td>".nl2br($p['d_pdk'])."</td>
							</tr>";
						}
					}
			?>
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
			</thead>
	<?php
		$nip=$_SESSION['namauser'];
		$ri=mysql_query("select * from pengalaman_kerja where nip='$_GET[id]' order by id_peker ASC");
			if(mysql_num_rows($ri)==0){
				echo "<tr><td colspan='2'>*Tidak Ada Data*</td></tr>";
			}else {

				while($p=mysql_fetch_array($ri)){
		echo "
			<tr>
				<td>$p[nm_pekerjaan]</td>
				<td>".nl2br($p['d_pekerjaan'])." </td>
			</tr>";
				}
			}
		echo "
			</table>
	</div>
		<div style='clear:both'></div>";	
?>
	<div style="text-align:center;padding:20px;">
			<input class="noPrint" type="button" value="Cetak Halaman" onclick="window.print()">
				<?php echo "<input type=button value=Batal onclick=self.history.back()>";?>
	</div>
</div>
</body>
</html>
