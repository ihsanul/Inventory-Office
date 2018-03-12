<?php
session_start();

include '../koneksi.php';
$kodeb = $_POST['kode_barang'];
$nama= $_POST['nama'];
$jenis = $_POST['jenis'];
$kondisi = $_POST['kondisi'];
$lokasi = $_POST['lokasi'];

$querym =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$kodeb'");
$datam=mysqli_fetch_array($querym);
if($datam['id_jenisbarang']!=$jenis){
	$queryx = mysqli_query($koneksi, "SELECT default_kodebarang FROM tb_jenisbarang WHERE id_jenisbarang='$jenis'");
	$datax=mysqli_fetch_array($queryx);
	$kode=$datax['default_kodebarang'];

	$querya = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang LIKE '$kode%' ORDER BY kode_barang DESC");
	$data=mysqli_fetch_array($querya);
	$maxid = $data['kode_barang'];
	if ($maxid==''||$maxid==$kode) {
		$x=1;
		$maxid=$kode.$x;
	}else{$maxid++;}
}else if($datam['id_jenisbarang']==$jenis){$maxid=$kodeb;}
$query = mysqli_query($koneksi, "UPDATE tb_barang SET kode_barang='$maxid', nama_barang='$nama', id_jenisbarang='$jenis', kondisi_barang='$kondisi', id_lokasi='$lokasi' WHERE kode_barang='$kodeb'");
if (!$query){echo "Gagal edit data";
}else {echo "Berhasil edit data";
	$query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	$data1=mysqli_fetch_array($query1);
	$maxid1 = $data1[0];
	if ($maxid1=='') {
		$maxid1=1;
	}else{$maxid1++;}
	$id_adminlog = $_SESSION['id_admin'];
	mysqli_query($koneksi, "INSERT INTO log_barang values ('$maxid1','$id_adminlog','Edit Data','$maxid',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>