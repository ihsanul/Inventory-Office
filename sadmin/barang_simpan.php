<?php
session_start();

include '../koneksi.php';
$jenis = $_POST['jenis'];
$queryx = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang WHERE id_jenisbarang='$jenis' AND ket_jenis='true'");
$datax=mysqli_fetch_array($queryx);
$kode=$datax['default_kodebarang'];

$querya = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang LIKE '$kode%' ORDER BY kode_barang DESC");
$data=mysqli_fetch_array($querya);
$maxid = $data['kode_barang'];
if ($maxid==''||$maxid==$kode) {
	$x=1;
	$maxid=$kode.$x;
}else{$maxid++;}
$kodeb=$maxid;
$nama = $_POST['nama'];
$kondisi = $_POST['kondisi'];
$lokasi = $_POST['lokasi'];

$query = mysqli_query($koneksi, "INSERT INTO tb_barang VALUES('$kodeb','$nama','$jenis','$kondisi','$lokasi','true')");
if (!$query){echo "Gagal simpan data";
}else {echo "Berhasil simpan data";
	$query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	$data1=mysqli_fetch_array($query1);
	$maxid1 = $data1[0];
	if ($maxid1=='') {
		$maxid1=1;
	}else{$maxid1++;}
	$id_adminlog = $_SESSION['id_admin'];
	mysqli_query($koneksi, "INSERT INTO log_barang values('$maxid1','$id_adminlog','Tambah Data','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>