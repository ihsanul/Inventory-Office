<?php
session_start();

include '../koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang ORDER BY id_jenisbarang DESC");
$data=mysqli_fetch_array($query);
$maxid = $data[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
$jenis = $_POST['jenis'];
$kode = $_POST['kode'];

$query = mysqli_query($koneksi, "INSERT INTO tb_jenisbarang VALUES('$maxid','$jenis','$kode','true')");
if (!$query){echo "Gagal simpan data";
}else {echo "Berhasil simpan data";}
mysqli_close($koneksi);
?>